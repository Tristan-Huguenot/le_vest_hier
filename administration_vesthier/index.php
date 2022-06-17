<?php

session_start();

require_once '../config.php';

require_once 'controller/Controller.php';
$controller = new Controller;

require_once 'model/Autoload.php';

Vesthier\Autoloader::register();

if(isset($_GET['dest'])){
    switch($_GET['dest']){
        case 'evenements':
            $page = $_GET['dest'];
            break;
        case 'blog':
            $page = $_GET['dest'];
            break;
        case 'categories':
            $page = $_GET['dest'];
            break; 
        case 'partenaires':
            $page = $_GET['dest'];
            break;
        default:
            $page = 'accueil';
    }
}
else $page = 'accueil';

$controller->$page();