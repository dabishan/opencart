<?php

$basename = basename(basename(__FILE__), '.php');

if (isset($_GET['route']) && !defined('TB_BASENAME')) {
    $route_parts = explode('/', $_GET['route']);
    if (count($route_parts) == 2 && $route_parts[0] == 'module' && $route_parts[1] != $basename) {
        return;
    }
} elseif (!defined('TB_BASENAME')) {
    return;
}

$boot_file = DIR_SYSTEM . 'vendor/' . $basename . '/admin/boot.php';

if (!is_file($boot_file)) {
    die('The BurnEngine boot file cannot be found. Please, ensure it is uploaded properly. The missing file is:  ' . $boot_file);
}

if (!is_readable($boot_file)) {
    die('The BurnEngine boot file is not readable. Please, change its permissions accordingly. The boot file is: ' . $boot_file);
}

require_once $boot_file;
require_once DIR_SYSTEM . 'vendor/' . $basename . '/admin/controller/ModuleController.php';

class ControllerModuleBurnEngine extends Theme_Admin_ModuleController
{
    public function install()
    {
        $this->getEngine()->getThemeExtension()->getInstaller()->installEngine('module');
    }
}