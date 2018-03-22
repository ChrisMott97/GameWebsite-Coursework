<div id="home" style="display: none;">
    <?php
        if(isset($_SESSION['username'])){
            $user = UserFactory::find($_SESSION['username']);
            include("partials/home_view.php");
        }
    ?>
</div>