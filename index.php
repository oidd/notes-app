<?php

require 'vendor/autoload.php';

use App\Core\Core;

session_start();

Dotenv\Dotenv::createImmutable(__DIR__)->load();

Core::run();