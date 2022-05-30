<?php

$apiDirs = ['auth', 'socials'];
$apiDirAuthElements = ['login'];
$apiDirSocialsElements = ['main', 'destroy'];

if (!isset($_GET['_page']) || !in_array($_GET['_page'], $apiDirs)) {
    header("Location: /404");
    exit();
}

require './' . Core::$CONT . '/' . $_GET['_module'] . '/' . $_GET['_page'] . '/' . $_GET['page2'] . '.php';

require './' . Core::$CONT . '/' . $_GET['_module'] . Core::$SKIN . '/' . $_GET['_page'] . '/view' . '/' . $_GET['page2'] . '.tpl';
