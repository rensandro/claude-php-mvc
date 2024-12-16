<?php
require_once 'controllers/StudentController.php';

$controller = new StudentController();

$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'index':
        $controller->index();
        break;
    case 'create':
        $controller->create();
        break;
    case 'edit':
        $controller->edit();
        break;
    case 'view':
        $controller->view();
        break;
    case 'delete':
        $controller->delete();
        break;
    default:
        $controller->index();
}