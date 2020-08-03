<?php

session_start();

require_once 'App/Core/Core.php';
require_once 'lib/Alison/Database/Connection.php';
require_once 'App/Controller/LoginController.php';
require_once 'App/Controller/DashboardController.php';
require_once 'vendor/autoload.php';
require_once 'App/Model/User.php';

$core = new Core;
echo $core->Start($_GET);