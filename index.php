<?php
/**
 * Example Application
 *
 * @package Example-application
 */

$path = dirname(__FILE__); 

require $path.'/libs/startup.php';

switch (isset($_GET["page"])?$_GET["page"]:""){
 
        case 'upload': 
                # account
                include 'pages/upload.php';
                $smarty->display('upload.html');
        break; 

        case 'torrents': 
                # account
                include 'pages/torrents.php';
                $smarty->display('torrents.html');
        break; 
 
        case 'stream': 
                # account
                include 'pages/stream.php';
                $smarty->display('stream.html');
        break; 
 
        case 'contact': 
                # account
                include 'pages/contact.php';
                $smarty->display('contact.html');
        break; 
 
        default:
        		include 'pages/main.php';
				$smarty->display('index.html');
        break;
}  
 


