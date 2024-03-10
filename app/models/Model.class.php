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

    // select all records
    protected function select($columns = ['*'], $as = "")
    {
        $columns = implode(', ', $columns);
        $this->query = "SELECT {$columns} FROM {$this->table} {$as}";
        return $this;
    }

    //where clause
    protected function where($condition)
    {
        $this->query .= " WHERE {$condition}";
        return $this;
    }

    //bind values to the query
    protected function bind($bindings = [])
    {
        $this->bindings = $bindings;
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
    protected function innerJoin($toJoinTable, $joinCondition)
    {
        $this->query .= " INNER JOIN {$toJoinTable} ON {$joinCondition}";
        return $this;
    }

    // left join the records
    //leftJoin('follow_relationships as f1', 'f1.following_id', 'u.id')
    protected function leftJoin($toJoinTable, $joinCondition)
    {
        $this->query .= " LEFT JOIN {$toJoinTable} ON {$joinCondition}";
        return $this;
    }



    // right join the records
    protected function rightJoin($toJoinTable, $joinCondition)
    {
        $this->query .= " RIGHT JOIN {$toJoinTable} ON {$joinCondition}";
        return $this;
    }

    //raw join
    protected function joinRaw($join)
    {
        $this->query .= " {$join}";
        return $this;
    }

    // offset the records
    protected function offset($offset)
    {
        $this->query .= " OFFSET {$offset}"; // example query: SELECT * FROM users OFFSET 10 LIMIT 10 this will get the second page of the records
        return $this;
    }

    public function paginate($page, $perPage)
    {
        $this->query .= " LIMIT {$perPage} OFFSET " . ($page - 1) * $perPage;
        return $this;
    }

}
