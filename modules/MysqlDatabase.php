<?php

namespace FirstAide;

class MysqlDatabase
{
    /**
     * @var \mysqli Original database object
     */
    private $db;
    private $stmt;

    public function __construct(\mysqli $db)
    {
        $this->db = $db;
    }

    public function prepare(string $query)
    {
        $this->stmt = $this->db->prepare($query);
        return $this;
    }

    public function bindParams()
    {
        $args = func_get_args();
        $refs = array();
        foreach ($args as $key => $value) {
            $refs[$key] = &$args[$key];
        }

        call_user_func_array(array($this->stmt, 'bind_param'), $refs);
        return $this;
    }

    public function execute()
    {
        $this->stmt->execute();
        return $this;
    }

    public function getAffectedRows()
    {
        return $this->stmt->affected_rows ?? 0;
    }

    public function getResults()
    {
        return new MysqlResult($this->stmt->get_result());
    }

    public function close()
    {
        return $this->stmt->close();
    }
}
