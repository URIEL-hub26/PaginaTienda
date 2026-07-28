<?php
session_start();

$_SESSION = [];

session_destroy();

header("Location: ../PagInicio/index.php");
exit;