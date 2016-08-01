<?php

namespace App\Reports;

use Illuminate\Database\DatabaseManager;

abstract class Report
{
    protected $db;
    protected $query;

    public function __construct(DatabaseManager $db)
    {
        $this->db = $db;
        $this->query = $this->buildBaseQuery();
    }

    public function get()
    {
        return $this->query->get();
    }

    abstract protected function buildBaseQuery();
}
