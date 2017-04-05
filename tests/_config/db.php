<?php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'sqlite:' . Yii::getAlias('@tests/_output/test.db'),
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];