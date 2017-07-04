<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'yii2basic',
    'password' => 'R785vaCU7Q5yxje8',
    'charset' => 'utf8',
    'on afterOpen' => function($event) {
        // $event->sender refers to the DB connection
        $event->sender->createCommand("SET time_zone = '+8:00'")->execute();
    }
];
