<?php

namespace app\core;

abstract class DbModel extends Model
{
    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ") 
                                        VALUES (" . implode(',', $params) . ")");

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        $statement->execute();
        return true;

    }

    abstract public function tableName(): string;

    abstract public function attributes(): array;

    public function prepare($sql)
    {
        return Application::$app->database->pdo->prepare($sql);
    }
}