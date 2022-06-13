<?php

$modulePath = './' . Core::$CONT . '/' . $_GET['_module'] . '/' . $_GET['_page'] . '/' . $_GET['page2'] . '.php';
$skinPath = './' . Core::$CONT . '/' . $_GET['_module'] . Core::$SKIN . '/' . $_GET['_page'] . '/view' . '/' . $_GET['page2'] . '.tpl';

if (!file_exists($modulePath) || !file_exists($skinPath)) {
    redirect('/404');
}

require $modulePath;

require $skinPath;
