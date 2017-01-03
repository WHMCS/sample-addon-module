<?php

// This is the bootstrap for PHPUnit testing.

if (!defined('WHMCS')) {
    define('WHMCS', true);
}

// Include the WHMCS module.
require_once __DIR__ . '/../modules/addons/addonmodule/addonmodule.php';
