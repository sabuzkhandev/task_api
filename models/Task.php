<?php

class Task
{
    private $conn;
    private $table = 'tasks';

    public $id;
    public $title;
    public $description;
    public $priority;
    public $is_completed;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllTasks()
    {
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getTaskById($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt;
    }

    public function createTask()
    {
        $query = "INSERT INTO {$this->table} (title, description, priority) VALUES (:title, :description, :priority)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':priority', $this->priority);

        return $stmt->execute();
    }

    public function updateTask()
    {
        $query = "UPDATE {$this->table} SET title = :title, description = :description, priority = :priority, is_completed = :is_completed WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':priority', $this->priority);
        $stmt->bindParam(':is_completed', $this->is_completed);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    public function deleteTask($id)
    {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
