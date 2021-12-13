<?php

class m00_initial_migration
{

    public function up()
    {
        $database = \app\core\Application::$app->database;
        $SQL = "CREATE TABLE users (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    email VARCHAR(255) NOT NULL,
                    firstname VARCHAR(255) NOT NULL,
                    lastname VARCHAR(255) NOT NULL,
                    status TINYINT NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                ) ENGINE=INNODB;";
        $database->pdo->exec($SQL);
    }

    public function down()
    {
        $database = \app\core\Application::$app->database;
        $SQL = "DROP TABLE users;";
        $database->pdo->exec($SQL);
    }
}