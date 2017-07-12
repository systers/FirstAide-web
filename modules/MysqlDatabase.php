<?php

namespace FirstAide;

class MysqlDatabase
{
    /**
     * @var \mysqli Original database object
     */
    private $db;

    public function __construct(\mysqli $db)
    {
        $this->db = $db;
    }

    public function prepare(string $query)
    {
        return $this->db->prepare($query);
    }
}
