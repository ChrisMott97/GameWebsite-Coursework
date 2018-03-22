<div id="login" style="display: none;">
    <?php
        if(!isset($_SESSION['username'])){
            include_once("partials/login_view.php");
        }
    ?>
</div>