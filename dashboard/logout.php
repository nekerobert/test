<?php require_once($_SERVER['DOCUMENT_ROOT'].'/private/init.php'); ?>
<?php confirm_user_login();?>

<?php
    logout_user();
    redirect_to(DASHBOARD_PATH.'login');

?>