<?php

class m01_add_password_column
{

    public function up()
    {
        $database = \app\core\Application::$app->database;
        $database->pdo->exec("ALTER TABLE users ADD COLUMN password VARCHAR(512) NOT NULL;");
    }

    public function down()
    {
        $database = \app\core\Application::$app->database;
        $database->pdo->exec("ALTER TABLE users DROP COLUMN password;");
    }
}