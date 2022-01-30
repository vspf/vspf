<?php

namespace Vspf\Core\Db;

class MysqlQueryBuilder implements QueryBuilder
{
    protected $sqlQuery;

    protected function reset(): void
    {
        $this->query = new \stdClass();
    }

    public function select(string $table, array $fields): QueryBuilder
    {
        $this->reset();
        $this->query->type = 'select';
        $this->query->base = "SELECT " . implode(", ", $fields) . " FROM " . $table;

        return $this;
    }

    /**
     * where
     *
     * @param  string $field
     * @param  string $value
     * @param  string $operator
     * @return QueryBuilder
     */
    public function where(string $field, string $value, string $operator = '='): QueryBuilder
    {
        if( !($this->isSelect() || $this->isUpdate() || $this->isDelete()))
        {
            throw new \Exception("WHERE cannot be used unless query is SELECT,UPDATE or DELETE");
        }

        $this->query->where[] = "$field $operator '$value'";

        return $this;
    }

    /**
     * @param $table
     * @param $condition
     * @return QueryBuilder
     * @throws \Exception
     */
    public function leftjoin($table, $condition): QueryBuilder
    {
        if(!$this->isSelect())
        {
            throw new \Exception("LEFT JOIN can only be used with SELECT query");
        }

        $this->query->join = " LEFT JOIN $table ON $condition ";

        return $this;
    }

    /**
     * limit
     *
     * @param  mixed $start
     * @param  mixed $end
     * @return QueryBuilder
     */
    public function limit(int $start, int $offset): QueryBuilder
    {
        if( !$this->isSelect())
        {
            throw new \Exception("LIMIT cannot be used except for SELECT query");
        }
        $this->query->limit = " LIMIT " . $start . ", " . $offset;

        return $this;
    }

    /**
     * @param string $field
     * @param string $order
     * @return QueryBuilder
     * @throws \Exception
     */
    public function orderby(string $field, string $order = 'ASC'): QueryBuilder
    {
        if( !$this->isSelect())
        {
            throw new \Exception("ORDER BY cannot be used except for SELECT query");
        }

        $this->query->orderby = " ORDER BY $field $order ";

        return $this;
    }

    /**
     * @return string
     */
    public function getSqlQuery(): string
    {
        $query = $this->query;
        $sql = $query->base;

        if(isset($this->query->join))
        {
            $sql .= $query->join;
        }

        if(!empty($this->query->where))
        {
            $sql .= " WHERE " . implode(' AND ', $query->where);
        }

        if(isset($this->query->limit))
        {
            $sql .= $query->limit;
        }

        $sql .= ";";

        return $sql;
    }

    /**
     * isSelect
     *
     * @return bool
     */
    public function isSelect(): bool
    {
        return $this->query->type === 'select' ? true : false;
    }

    /**
     * isUpdate
     *
     * @return bool
     */
    public function isUpdate(): bool
    {
        return $this->query->type === 'update' ? true : false;
    }

    /**
     * isDelete
     *
     * @return bool
     */
    public function isDelete(): bool
    {
        return $this->query->type === 'delete' ? true : false;
    }
}