<?php

namespace App\Repository;

use App\Models\Categories;
use App\Util\Database;
use App\Util\Pagination;
use PDO;

class CategoriesRepository
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function create(Categories $model)
    {
        $sql = "INSERT INTO categories (name, description, created_at) VALUES (:name, :description, CURRENT_TIMESTAMP)";
        $stmt = $this->db->prepare($sql);
        $name = $model->getName();
        $stmt->bindParam(':name', $name);
        $description = $model->getDescription();
        $stmt->bindParam(':description', $description);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function read(int $id): ?Categories
    {
        $sql = "SELECT * FROM categories WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? Categories::fromDatabaseResult($result) : null;
    }

    public function update(Categories $model)
    {
        $sql = "UPDATE categories SET name = :name, description = :description WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $name = $model->getName();
        $stmt->bindParam(':name', $name);
        $description = $model->getDescription();
        $stmt->bindParam(':description', $description);
        $id = $model->getId();
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function list(Pagination $pagination): array
    {
        $sql = "SELECT * FROM categories LIMIT :offset, :limit";
        $stmt = $this->db->prepare($sql);
        $offset = $pagination->getOffset();
        $limit = $pagination->getLimit();
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($result) => Categories::fromDatabaseResult($result), $results);
    }
}
