<?php
	session_start();
	require_once "GoogleAPI/vendor/autoload.php";
	$gClient = new Google_Client();
	$gClient->setClientId("343566041727-np9bok6nlups2lpqrr2ti54dshcs0224.apps.googleusercontent.com");
	$gClient->setClientSecret("73ZJ94AzVqc0mLErRsQQYp_s");
	$gClient->setApplicationName("Web_Login_with_Google");
	$gClient->setRedirectUri("http://localhost/quiz_oops/home.php");
	$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
?>
