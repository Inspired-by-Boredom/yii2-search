<?php
return [
    'db' => require(__DIR__ . '/db.php'),

    'searcher' => [
        'class' => \vintage\search\SearchComponent::className(),
        'models' => [
            'article' => [
                'class' => \tests\models\Article::className(),
                'label' => 'Test label'
            ]
        ]
    ]
];
