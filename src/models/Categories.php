<?php

namespace App\Models;

class Categories
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
    private string $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
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
    private ?string $created_at;

    public function getCreated_at(): ?string
    {
        return $this->created_at;
    }

    public function setCreated_at(?string $created_at): void
    {
        $this->created_at = $created_at;
    }

    public static function fromDatabaseResult($result): self
    {
        $object = new self();
        $object->id = $result['id'];
        $object->name = $result['name'];
        $object->description = $result['description'];
        $object->created_at = $result['created_at'];
        return $object;
    }

    public function setFromJson($json): self
    {
        $data = json_decode($json, true);
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }
        if (isset($data['name'])) {
            $this->name = $data['name'];
        }
        if (isset($data['description'])) {
            $this->description = $data['description'];
        }
        if (isset($data['created_at'])) {
            $this->created_at = $data['created_at'];
        }
        return $this;
    }

    public function toArray(): array
    {
        $array = [];
        $array['id'] = $this->id;
        $array['name'] = $this->name;
        $array['description'] = $this->description;
        $array['created_at'] = $this->created_at;
        return $array;
    }
}
