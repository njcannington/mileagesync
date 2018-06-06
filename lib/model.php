<?php
namespace Lib;

use Lib\Db\Record;

/**
 * base class for all models
 */
class Model
{
    protected $record;
    protected $table;
    protected $columns = [];

    public function __construct()
    {
        $this->setup();
        $this->record = new Record($this->table);
    }
    /*
    ***************************************
    *      METHODS TO SET PROPERTIES
    ***************************************
    */

    protected function hasTable($table)
    {
        $this->table = $table;
    }

    protected function hasColumn($column)
    {
        $this->column[$column] = null;
    }

    /*
    ***************************************
    *      METHODS TO OBTAIN PROPERTIES
    ***************************************
    */

    /*
    ***************************************
    *            PUBLIC METHODS
    ***************************************
    */

    /*
    * inserts $this->columns in current instane
    * into $this->table
    */
    public function save()
    {
        $data = [];
        $this->column["created_at"] = date("Y-m-d H:i:s", time());
        foreach ($this->column as $col => $val) {
            if ($col !== "id") {
                $data[$col] = "'{$val}'";
            }
        }
        $this->record->insert($data);
    }

    /*
    ***************************************
    *           PROTECTED METHODS
    ***************************************
    */

    protected function setInstance($record)
    {
        foreach ($this->column as $column_name => $val) {
            $this->column[$column_name] = $record[$column_name];
        }
    }
}
