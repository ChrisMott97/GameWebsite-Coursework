<div id="dashboard" style="display: none;">
    <?php
        if(isset($_SESSION['username'])){
            $user = UserFactory::find($_SESSION['username']);
            include("partials/admin_view.php");
        }
    ?>
</div>