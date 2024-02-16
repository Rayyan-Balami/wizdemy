<?php

class Model extends Database
{
    protected $table; // The table name
    protected $query; // The query to be executed
    protected $bindings = []; // The values to be bound to the query
    protected $fillable = []; // The columns that are allowed to be mass-assigned

    public function __construct($table)
    {
        $this->table = $table;
        parent::__construct();
    }

    protected function execute()
    {
        $this->statement = $this->conn->prepare($this->query);
        $this->statement->execute($this->bindings);
        return $this;
    }

    // get the first record
    protected function get()
    {
        return $this->execute()->statement->fetch();
    }

    // get all records
    protected function getAll()
    {
        return $this->execute()->statement->fetchAll();

    }

    protected function getOrFail($status = 404)
    {
        $result = $this->get();
        if (!$result) {
            $this->abort($status);
        }
        return $result;
    }

    protected function getAllOrFail($status = 404)
    {
        $result = $this->getAll();
        if (!$result) {
            $this->abort($status);
        }
        return $result;
    }

    protected function abort($code = 404)
    {
        http_response_code($code);
        require_once base_path("views/{$code}.view.php");
        die();
    }

    // select all records
    protected function select($columns = ['*'])
    {
        $columns = implode(', ', $columns);
        $this->query = "SELECT {$columns} FROM {$this->table}";
        return $this;
    }

    //where clause
    protected function where($column, $value, $operator = '=')
    {
        $column_param = str_replace('.', '_', $column);
        $this->query .= " WHERE {$column} {$operator} :{$column_param}";
        $this->bindings[":{$column_param}"] = $value;
        return $this;
    }

    // orWhere clause
    protected function orWhere($column, $value, $operator = '=')
    {
        $column_param = str_replace('.', '_', $column);
        $this->query .= " OR {$column} {$operator} :{$column_param}";
        $this->bindings[":{$column_param}"] = $value;
        return $this;
    }

    //andWhere clause
    protected function andWhere($column, $value, $operator = '=')
    {
        $column_param = str_replace('.', '_', $column);
        $this->query .= " AND {$column} {$operator} :{$column_param}";
        $this->bindings[":{$column_param}"] = $value;
        return $this;
    }

    // insert a record
    protected function insert($data = [])
    {
        //unset keys that are not fillable (security measure)
        if (!empty($this->fillable)) {
            $data = array_intersect_key($data, array_flip($this->fillable));
        }
        //[
        //  'name' => 'John Doe',
        //  'email' => 'email"
        // ]
        $columns = implode(',', array_keys($data)); // name, email
        $values = implode(',', array_map(function ($value) {
            return ":{$value}";
        }, array_keys($data))); // :name, :email
        $this->query = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";
        $this->bindings = $data;
        return $this;
    }

    // update a record
    protected function update($data = [])
    {
        //unset keys that are not fillable (security measure)
        if (!empty($this->fillable)) {
            $data = array_intersect_key($data, array_flip($this->fillable));
        }
        //[
        //  'name' => 'John Doe',
        //  'email' => 'email"
        // ]
        $columns = implode(',', array_map(function ($value) {
            return "{$value} = :{$value}";
        }, array_keys($data))); // name = :name, email = :email
        $this->query = "UPDATE {$this->table} SET {$columns}";
        $this->bindings = $data;
        return $this;
    }

    // delete a record
    protected function delete()
    {
        $this->query = "DELETE FROM {$this->table}";
        return $this;
    }

    // limit the number of records
    protected function limit($limit)
    {
        $this->query .= " LIMIT {$limit}";
        return $this;
    }

    // order the records
    protected function orderBy($column, $direction = 'ASC')
    {
        $this->query .= " ORDER BY {$column} {$direction}";
        return $this;
    }

    // get the count of records
    protected function count($column = '*')
    {
        $this->query = "SELECT COUNT({$column}) FROM {$this->table}";
        return $this;
    }

    // group the records
    protected function groupBy($column)
    {
        $this->query .= " GROUP BY {$column}";
        return $this;
    }

    // inner join the records
    protected function innerJoin($foreignTable, $commonKey)
    {
        $this->query .= " INNER JOIN {$foreignTable} ON {$this->table}.{$commonKey} = {$foreignTable}.{$commonKey}";
        return $this;
    }

    // left join the records
    protected function leftJoin($foreignTable, $commonKey)
    {
        $this->query .= " LEFT JOIN {$foreignTable} ON {$this->table}.{$commonKey} = {$foreignTable}.{$commonKey}";
        return $this;
    }

    // right join the records
    protected function rightJoin($foreignTable, $commonKey)
    {
        $this->query .= " RIGHT JOIN {$foreignTable} ON {$this->table}.{$commonKey} = {$foreignTable}.{$commonKey}";
        return $this;
    }

    // offset the records
    protected function offset($offset)
    {
        $this->query .= " OFFSET {$offset}"; // example query: SELECT * FROM users OFFSET 10 LIMIT 10 this will get the second page of the records
        return $this;
    }

}
