<?php

namespace App\Models;

use App\Database\Database;
use App\Interfaces\ModelInterface;

abstract class Model implements ModelInterface
{
    public int $id;
    protected Database $db;
    protected static string $table;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    function mapToModel(array $data): Model
    {
        $model = new static();
        foreach ($data as $key => $value) {
            if (property_exists($model, $key)) {
                $model->$key = $value;
            }
        }
        return $model;
    }

    static function select(): string
    {
        return "SELECT * FROM `" . static::$table . "`";
    }

    static function orderBy($orderBy = []): string
    {
        if (empty($orderBy)) {
            return "";
        }

        $orderByClauses = [];

        // extract 'orderBY' and 'direction' fields
        $fields = $orderBy["order_by"] ?? [];
        $directions = $orderBy["direction"] ?? [];

        foreach ($fields as $index => $field) {
            // use the corresponding direction or default to 'ASC'
            $direction = $directions[$index] ?? "ASC";
            $orderByClauses[] = "$field $direction";
        }

        if (empty($orderByClauses)) {
            return "";
        }

        return "ORDER BY " . implode(", ", $orderByClauses). ",";
    }

    function find($id): ?static {
        $sql = self::select() . " WHERE `id` = :id";

        $qryResult = $this->db->execSql($sql, [ "id" => $id ]);
        if (empty($qryResult)) {
            return null;
        }

        return $this->mapToModel($qryResult[0]);
    }

    function all($orderBy = []): array
    {
        $sql = self::select();

        $sql .= self::orderBy($orderBy);

        $sqlResult = $this->db->execSql($sql);
        if (empty($sqlResult)) {
            return [];
        }

        $results = [];
        foreach ($sqlResult as $row) {
            $results[] = $this->mapToModel($row);
        }

        return $results;
    }
}