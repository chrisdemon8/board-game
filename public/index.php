<?php
use Framework\Kernel;

require_once(__DIR__ . '/../vendor/autoload.php');

$kernel = new Kernel();
$kernel->handle($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
