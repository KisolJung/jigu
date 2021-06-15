<?php
session_start();
$account=null; $nickname=null; $user_id = null;
if (isset($_SESSION["account"])) $account = $_SESSION["account"];
if (isset($_SESSION["nickname"])) $nickname = $_SESSION["nickname"];
if (isset($_SESSION["user_id"])) $user_id = $_SESSION["user_id"];
?>
