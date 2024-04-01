<?php

/**
 * Model class
 * 
 * This class contains methods for interacting with the database.
 * 
 * methods: get, getAll, select, where, bind, appendBindings, insert, update, delete, limit, orderBy, count, groupBy, innerJoin, leftJoin, rightJoin, joinRaw, offset, paginate
 */
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

    protected function prepare(){
        $this->statement = $this->conn->prepare($this->query);
        return $this;
    }

    /**
     * Execute the query
     * 
     * equivalent to running the query in the database
     * 
     * @return $this
     */
    protected function execute()
    {
        try {
            $this->statement = $this->conn->prepare($this->query);
            $this->statement->execute($this->bindings);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $this;
    }

    /**
     * Get a single record
     * 
     * equivalent to : SELECT * FROM table WHERE condition
     * 
     * @return array
     */
    protected function get()
    {
        return $this->execute()->statement->fetch();
    }

    /**
     * Get all records
     * 
     * equivalent to : SELECT * FROM table
     * 
     * @return array
     */
    protected function getAll()
    {
        return $this->execute()->statement->fetchAll();
    }

    /**
     * Select columns
     * 
     * equivalent to : SELECT $columns FROM table $as
     * 
     * @param array $columns The columns to select
     * @param string $as The alias for the table
     * 
     * @return $this
     */
    protected function select(array $columns = ['*'], string $as = "")
    {
        $columns = implode(', ', $columns);
        $this->query = "SELECT {$columns} FROM {$this->table} {$as}";
        return $this;
    }

    /**
     * Add a where clause
     * 
     * equivalent to : SELECT * FROM table WHERE $condition
     * 
     * @param string $condition The condition to add
     * 
     * @return $this
     */
    protected function where(string $condition)
    {
        $this->query .= " WHERE {$condition}";
        return $this;
    }

    /**
     * Bind values to the query
     * 
     * equivalent to : SELECT * FROM table WHERE $bindings['column'] = $bindings['value']
     * 
     * @param array $bindings The values to bind
     * 
     * @return $this
     */
    protected function bind(array $bindings = [])
    {
        $this->bindings = $bindings;
        return $this;
    }

    /**
     * Append bindings to the query
     * 
     * equivalent to : SELECT * FROM table WHERE $bindings['column'] = $bindings['value'] AND $bindings['column2'] = $bindings['value2']
     * 
     * @param array $bindings The values to bind
     * 
     * @return $this
     */
    protected function appendBindings(array $bindings = [])
    {
        $this->bindings = array_merge($this->bindings, $bindings);
        return $this;
    }

    /**
     * Insert a record
     * 
     * equivalent to : INSERT INTO table ($data['column']) VALUES ($data['value'])
     * @param array $data The data to insert
     * 
     * @return $this
     */
    protected function insert(array $data = [])
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

    /**
     * Update a record
     * 
     * equivalent to : UPDATE table SET $data['column'] = $data['value']
     * 
     * @param array $data The data to update
     * 
     * @return $this
     */
    protected function update(array $data = [])
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

    /**
     * Delete a record
     * 
     * @return $this
     */
    protected function delete()
    {
        $this->query = "DELETE FROM {$this->table}";
        return $this;
    }

    /**
     * Limit the records
     * 
     * equivalent to : SELECT * FROM table LIMIT $limit
     * 
     * @param int $limit The number of records to limit
     * 
     * @return $this
     */
    protected function limit(int $limit)
    {
        $this->query .= " LIMIT {$limit}";
        return $this;
    }

    /**
     * Order the records
     * 
     * equivalent to : SELECT * FROM table ORDER BY $column $direction
     * 
     * @param string $column The column to order by
     * @param string $direction The direction to order by
     * 
     * @return $this
     */
    protected function orderBy(string $column, string $direction = 'ASC')
    {
        $this->query .= " ORDER BY {$column} {$direction}";
        return $this;
    }

    /**
     * Count the records
     * 
     * equivalent to : SELECT COUNT(*) FROM table
     * 
     * @param string $column The column to count
     * 
     * @return $this
     */
    protected function count(string $column = '*')
    {
        $this->query = "SELECT COUNT({$column}) FROM {$this->table}";
        return $this;
    }

    /**
     * Group the records
     * 
     * equivalent to : SELECT * FROM table GROUP BY $column
     * 
     * @param string $column The column to group by
     * 
     * @return $this
     */
    protected function groupBy(string $column)
    {
        $this->query .= " GROUP BY {$column}";
        return $this;
    }

    /**
     * Inner join the records
     * 
     * equivalent to : SELECT * FROM table INNER JOIN $toJoinTable ON $joinCondition
     * 
     * @param string $toJoinTable The table to join
     * @param string $joinCondition The condition to join
     * 
     * @return $this
     */
    protected function innerJoin(string $toJoinTable, string $joinCondition)
    {
        $this->query .= " INNER JOIN {$toJoinTable} ON {$joinCondition}";
        return $this;
    }

    /**
     * Left join the records
     * 
     * equivalent to : SELECT * FROM table LEFT JOIN $toJoinTable ON $joinCondition
     * 
     * @param string $toJoinTable The table to join
     * @param string $joinCondition The condition to join
     * 
     * @return $this
     */
    protected function leftJoin(string $toJoinTable, string $joinCondition)
    {
        $this->query .= " LEFT JOIN {$toJoinTable} ON {$joinCondition}";
        return $this;
    }



    /**
     * Right join the records
     * 
     * equivalent to : SELECT * FROM table RIGHT JOIN $toJoinTable ON $joinCondition
     * 
     * @param string $toJoinTable The table to join
     * @param string $joinCondition The condition to join
     * 
     * @return $this
     */
    protected function rightJoin(string $toJoinTable, string $joinCondition)
    {
        $this->query .= " RIGHT JOIN {$toJoinTable} ON {$joinCondition}";
        return $this;
    }

    /**
     * Join the records
     * 
     * equivalent to : SELECT * FROM table $join
     * 
     * @param string $join The join to add
     * 
     * @return $this
     */
    protected function joinRaw(string $join)
    {
        $this->query .= " {$join}";
        return $this;
    }

    /**
     * Offset the records
     * 
     * equivalent to : SELECT * FROM table OFFSET $offset
     * 
     * @param int $offset The number of records to offset
     * 
     * @return $this
     */
    protected function offset(int $offset)
    {
        $this->query .= " OFFSET {$offset}"; // example query: SELECT * FROM users OFFSET 10 LIMIT 10 this will get the second page of the records
        return $this;
    }

    /**
     * Paginate the records
     * 
     * equivalent to : SELECT * FROM table LIMIT $perPage OFFSET ($page - 1) * $perPage
     * 
     * @param int $page The page number
     * @param int $perPage The number of records per page
     * 
     * @return $this
     */
    public function paginate(int $page, int $perPage)
    {
        $this->query .= " LIMIT {$perPage} OFFSET " . ($page - 1) * $perPage;
        return $this;
    }

}
