<?php

require 'Smarty.class.php';
require 'TransmissionRPC.class.php';
require 'default.class.php'; 
$smarty = new Smarty;
$rpc    = new TransmissionRPC();
$startUp = new SeedBox;

// Smarty config
$smarty->addPluginsDir($path.'/libs/plugins/');
$smarty->template_dir = $path.'/themes/default/';
$smarty->compile_dir = $path.'/cache/compile_tpl/';
$smarty->cache_dir = $path.'/cache/';
$smarty->debugging = false;
$smarty->caching = false;
$smarty->cache_lifetime = 0;

