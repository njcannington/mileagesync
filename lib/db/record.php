<?php
namespace Lib\Db;

/**
 * Accesses records within Database
 */
class Record
{
    protected $db;
    protected $table;

    public function __construct($table)
    {
        $this->db = \Lib\Db::getInstance();
        $this->table = $table;
    }

    /*
    ***************************************
    *           PUBLIC METHODS
    ***************************************
    */

    /*
    * executes sql SELECT query from $table in current instance
    * returns only values specified in $col
    * (optional $where clause using ["column" => value] syntax)
    */
    public function fetchOne($col, $where = null)
    {
        $where_clause = (!is_null($where)) ? $this->buildWhere($where) : '';
        $sql = "SELECT {$col} FROM {$this->table} ".$where_clause;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
        if (count($results) == 1) {
            return $results[0];
        } elseif (empty($results)) {
            return false;
        }
        return $results;
    }

    /*
    * executes sql SELECT query from $table in current instance
    * returns all column values
    * (optional $where clause using ["column" => value] syntax)
    */
    public function fetchAll($where = null)
    {
        $where_clause = (!is_null($where)) ? $this->buildWhere($where) : '';
        $sql = "SELECT * FROM {$this->table} ".$where_clause;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
        if (count($results) == 1) {
            return $results[0];
        } elseif (empty($results)) {
            return false;
        }
        return $results;
    }

    public function insert($data)
    {
        $columns = join(",", array_keys($data));
        $values = join(",", $data);
        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
    }

    /*
    ***************************************
    *         PROTECTED METHODS
    ***************************************
    */

    /*
    * converts the $where used in the fetch methods
    * to usable string for sql queries
    */
    protected function buildWhere($where)
    {
        $sql_parts = [];
        foreach ($where as $col => $val) {
            $sql_parts[] = "$col = '{$val}'";
        }
        $sql = join(" AND ", $sql_parts);

        return "WHERE ".$sql;
    }
    /*
    ***************************************
    *      METHODS TO SET PROPERTIES
    ***************************************
    */
    /*
    ***************************************
    *      METHODS TO OBTAIN PROPERTIES
    ***************************************
    */

}
