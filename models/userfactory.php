<?php

class UserFactory {

    private static $db;

    public static function setDependencies($db){
        self::$db = $db;
    }

    public static function find($username){
        $statement = self::$db->prepare("SELECT * FROM users WHERE username = ?");
        $statement->bind_param('s', $username);
        $statement->execute();
        $statement->bind_result(
            $id,
            $username,
            $password,
            $firstname,
            $lastname,
            $permission,
            $created_at,
            $updated_at
        );
        while($statement->fetch()){
            $user = new User();
            $user->read($id, $username, $password, $firstname, $lastname, $permission, $created_at, $updated_at);
            return $user;
        }
        $statement->close();
    }

    public static function create($username, $password, $firstname, $lastname, $permission){
        $password = password_hash($password, PASSWORD_BCRYPT);
        $user = new User();
        $user->create($username, $password, $firstname, $lastname, $permission);
        return $user;
    }

    public static function insert($username, $password, $firstname, $lastname, $permission){
        $stmt = self::$db->prepare("INSERT INTO users (username, password, firstname, lastname, permission) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssi', $username, $password, $firstname, $lastname, $permission);
        $stmt->execute();
        $stmt->close();

        return self::find($username);
    }

    public static function auth($username, $password){
        if($user = self::find($username)){
            if(password_verify($password, $user->getPassword())){
                return $user;
            }
        }
        return NULL;
    }
}