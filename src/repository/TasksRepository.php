<?php

namespace App\Repository;

use App\Models\Tasks;
use App\Util\Database;
use App\Util\Pagination;
use PDO;

class TasksRepository
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function create(Tasks $model)
    {
        $sql = "INSERT INTO tasks (title, description, due_date, priority, status, category_id, created_at, updated_at) VALUES (:title, :description, :due_date, :priority, :status, :category_id, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
        $stmt = $this->db->prepare($sql);
        $title = $model->getTitle();
        $stmt->bindParam(':title', $title);
        $description = $model->getDescription();
        $stmt->bindParam(':description', $description);
        $due_date = $model->getDue_date();
        $stmt->bindParam(':due_date', $due_date);
        $priority = $model->getPriority();
        $stmt->bindParam(':priority', $priority);
        $status = $model->getStatus();
        $stmt->bindParam(':status', $status);
        $category_id = $model->getCategory_id();
        $stmt->bindParam(':category_id', $category_id);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function read(int $id): ?Tasks
    {
        $sql = "SELECT * FROM tasks WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? Tasks::fromDatabaseResult($result) : null;
    }

    public function update(Tasks $model)
    {
        $sql = "UPDATE tasks SET title = :title, description = :description, due_date = :due_date, priority = :priority, status = :status, category_id = :category_id, updated_at = CURRENT_TIMESTAMP WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $title = $model->getTitle();
        $stmt->bindParam(':title', $title);
        $description = $model->getDescription();
        $stmt->bindParam(':description', $description);
        $due_date = $model->getDue_date();
        $stmt->bindParam(':due_date', $due_date);
        $priority = $model->getPriority();
        $stmt->bindParam(':priority', $priority);
        $status = $model->getStatus();
        $stmt->bindParam(':status', $status);
        $category_id = $model->getCategory_id();
        $stmt->bindParam(':category_id', $category_id);
        $id = $model->getId();
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM tasks WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function list(Pagination $pagination): array
    {
        $sql = "SELECT * FROM tasks LIMIT :offset, :limit";
        $stmt = $this->db->prepare($sql);
        $offset = $pagination->getOffset();
        $limit = $pagination->getLimit();
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($result) => Tasks::fromDatabaseResult($result), $results);
    }
}
