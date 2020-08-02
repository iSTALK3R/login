<?php

require_once 'App/Core/Core.php';
require_once 'App/Controller/LoginController.php';
require_once 'vendor/autoload.php';

$core = new Core();
echo $core->Start($_GET);