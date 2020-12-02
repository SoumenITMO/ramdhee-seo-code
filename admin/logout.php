<?PHP
	include_once '../init.php';

    $_SESSION['ADMIN_USER_ID'] = FALSE;
    session_destroy();
    header("location:".ADMIN_SITE_URL."seo/index.php");

?>