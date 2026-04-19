<?php
session_start();

session_destroy();

header("Location: session_login.html");
exit;
?>