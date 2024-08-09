<?php

namespace App\Util;

class Pagination
{
    private $limit;
    private $offset;

    public function __construct(int $page, int $limit = 10)
    {
        $this->limit = $limit;
        $this->offset = ($page - 1) * $limit;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }
}
