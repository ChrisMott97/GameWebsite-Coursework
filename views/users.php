<div id="users" style="display: none;">
    <?php
        if(isset($_SESSION['username'])){
            $user = UserFactory::find($_SESSION['username']);
            include("partials/users_view.php");
        }
    ?>
</div>