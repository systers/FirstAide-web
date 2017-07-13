<?php

namespace FirstAide;

class MysqlDatabase
{
    /**
     * @var \mysqli Original database object
     */
    private $db;
    private $stmt;

    public $affected_rows;

    public function __construct(\mysqli $db)
    {
        $this->db = $db;
    }

    public function prepare(string $query)
    {
        $this->stmt = $this->db->prepare($query);
        return $this;
    }

    public function bind_param()
    {
        $args = func_get_args();
        $refs = array();
        foreach($args as $key => $value) {
            $refs[$key] = &$args[$key];
        }

        call_user_func_array(array($this->stmt, 'bind_param'), $refs);
        return $this;
    }

    public function execute()
    {
        $this->stmt->execute();
        $this->affected_rows = $this->stmt->affected_rows;
        return $this;
    }

    public function get_result()
    {
        return new MysqlResult($this->stmt->get_result());
    }

    public function close()
    {
        return $this->stmt->close();
    }
}
 