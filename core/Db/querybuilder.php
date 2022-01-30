<?php

namespace Vspf\Core\Db;

interface QueryBuilder
{
    public function select(string $table, array $fields): QueryBuilder;

    public function where(string $field, string $value, string $operator = '='): QueryBuilder;

    public function limit(int $start, int $offset): QueryBuilder;

    public function orderBy(string $field, string $order = 'ASC'): QueryBuilder;

    public function leftJoin($table, $condition): QueryBuilder;

    public function getSqlQuery(): string;

    public function isSelect(): bool;

    public function isUpdate(): bool;

    public function isDelete(): bool;
}