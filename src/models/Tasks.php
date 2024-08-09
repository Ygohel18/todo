<?php

namespace App\Models;

class Tasks
{
    private ?int $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }
    private string $title;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
    private ?string $description;

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
    private ?string $due_date;

    public function getDue_date(): ?string
    {
        return $this->due_date;
    }

    public function setDue_date(?string $due_date): void
    {
        $this->due_date = $due_date;
    }
    private mixed $priority;

    public function getPriority(): mixed
    {
        return $this->priority;
    }

    public function setPriority(mixed $priority): void
    {
        $this->priority = $priority;
    }
    private mixed $status;

    public function getStatus(): mixed
    {
        return $this->status;
    }

    public function setStatus(mixed $status): void
    {
        $this->status = $status;
    }
    private ?int $category_id;

    public function getCategory_id(): ?int
    {
        return $this->category_id;
    }

    public function setCategory_id(?int $category_id): void
    {
        $this->category_id = $category_id;
    }
    private ?string $created_at;

    public function getCreated_at(): ?string
    {
        return $this->created_at;
    }

    public function setCreated_at(?string $created_at): void
    {
        $this->created_at = $created_at;
    }
    private ?string $updated_at;

    public function getUpdated_at(): ?string
    {
        return $this->updated_at;
    }

    public function setUpdated_at(?string $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    public static function fromDatabaseResult($result): self
    {
        $object = new self();
        $object->id = $result['id'];
        $object->title = $result['title'];
        $object->description = $result['description'];
        $object->due_date = $result['due_date'];
        $object->priority = $result['priority'];
        $object->status = $result['status'];
        $object->category_id = $result['category_id'];
        $object->created_at = $result['created_at'];
        $object->updated_at = $result['updated_at'];
        return $object;
    }

    public function setFromJson($json): self
    {
        $data = json_decode($json, true);
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }
        if (isset($data['title'])) {
            $this->title = $data['title'];
        }
        if (isset($data['description'])) {
            $this->description = $data['description'];
        }
        if (isset($data['due_date'])) {
            $this->due_date = $data['due_date'];
        }
        if (isset($data['priority'])) {
            $this->priority = $data['priority'];
        }
        if (isset($data['status'])) {
            $this->status = $data['status'];
        }
        if (isset($data['category_id'])) {
            $this->category_id = $data['category_id'];
        }
        if (isset($data['created_at'])) {
            $this->created_at = $data['created_at'];
        }
        if (isset($data['updated_at'])) {
            $this->updated_at = $data['updated_at'];
        }
        return $this;
    }

    public function toArray(): array
    {
        $array = [];
        $array['id'] = $this->id;
        $array['title'] = $this->title;
        $array['description'] = $this->description;
        $array['due_date'] = $this->due_date;
        $array['priority'] = $this->priority;
        $array['status'] = $this->status;
        $array['category_id'] = $this->category_id;
        $array['created_at'] = $this->created_at;
        $array['updated_at'] = $this->updated_at;
        return $array;
    }
}
