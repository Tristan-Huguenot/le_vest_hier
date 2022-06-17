<?php
echo password_hash('admin', PASSWORD_DEFAULT);
session_start();

require_once 'config.php';

require_once 'controller/Controller.php';
$controller = new Controller;

require_once 'model/Autoload.php';

Vesthier\Autoloader::register();

if(isset($_GET['dest'])){
    switch($_GET['dest']){
        case 'article':
            $page = $_GET['dest'];
            break;
        case 'blog':
            $page = $_GET['dest'];
            break;
        case 'une_recyclerie':
            $page = $_GET['dest'];
            break;
        case 'evenement':
            $page = $_GET['dest'];
            break;
        case 'evenements':
            $page = $_GET['dest'];
            break;
        case 'mentions':
            $page = $_GET['dest'];
            break;
        default:
            $page = 'accueil';
    }
}
else{
    $page = 'accueil';
}

$controller->$page();