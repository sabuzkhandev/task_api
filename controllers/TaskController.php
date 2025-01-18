<?php

require_once 'models/Task.php';

class TaskController
{
    private $task;

    public function __construct($db)
    {
        $this->task = new Task($db);
    }

    public function getAllTasks()
    {
        $stmt = $this->task->getAllTasks();
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($tasks) > 0) {
            echo json_encode($tasks);
        } else {
            echo json_encode(['message' => 'No tasks available.']);
        }
    }

    public function getTaskById($id)
    {
        $stmt = $this->task->getTaskById($id);
        $task = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($task) {
            echo json_encode($task);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Task not found.']);
        }
    }

    public function createTask($data)
    {
        if (empty($data['title'])) {
            echo json_encode(['error' => 'Title is required.']);
            return;
        }

        $this->task->title = $data['title'];
        $this->task->description = $data['description'] ?? null;
        $this->task->priority = $data['priority'] ?? 'low';

        if (!in_array($this->task->priority, ['low', 'medium', 'high'])) {
            echo json_encode(['error' => 'Invalid priority value.']);
            return;
        }

        if ($this->task->createTask()) {
            echo json_encode(['message' => 'Task created successfully.']);
        } else {
            echo json_encode(['error' => 'Failed to create task.']);
        }
    }

    public function updateTask($id, $data)
    {
        $this->task->id = $id;
        $this->task->title = $data['title'] ?? '';
        $this->task->description = $data['description'] ?? '';
        $this->task->priority = $data['priority'] ?? 'low';
        $this->task->is_completed = $data['is_completed'] ?? 0;

        if (!in_array($this->task->priority, ['low', 'medium', 'high'])) {
            echo json_encode(['error' => 'Invalid priority value.']);
            return;
        }

        if ($this->task->updateTask()) {
            echo json_encode(['message' => 'Task updated successfully.']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Task not found.']);
        }
    }

    public function deleteTask($id)
    {
        if ($this->task->deleteTask($id)) {
            echo json_encode(['message' => 'Task deleted successfully.']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Task not found.']);
        }
    }
}
