<?php
session_start();
require 'autoload.php';

use App\Models\Admin;

$_SESSION = [];

session_destroy();

header("Location: login.php");
exit;