<?php

require_once 'config/Database.php';
require_once 'controllers/TaskController.php';

$database = new Database();
$db = $database->connect();

$taskController = new TaskController($db);

$requestMethod = $_SERVER['REQUEST_METHOD'];
$uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

if ($uri[0] === 'tasks') {
    switch ($requestMethod) {
        case 'GET':
            if (isset($uri[1])) {
                $taskController->getTaskById($uri[1]);
            } else {
                $taskController->getAllTasks();
            }
            break;
        case 'POST':
            $data = json_decode(file_get_contents('php://input'), true);
            $taskController->createTask($data);
            break;
        case 'PUT':
            $data = json_decode(file_get_contents('php://input'), true);
            $taskController->updateTask($uri[1], $data);
            break;
        case 'DELETE':
            $taskController->deleteTask($uri[1]);
            break;
        default:
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed.']);
    }
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Endpoint not found.']);
}
