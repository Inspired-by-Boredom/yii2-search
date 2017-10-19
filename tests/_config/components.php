<?php
return [
    'db' => require(__DIR__ . '/db.php'),

    'searcher' => [
        'class' => \vintage\search\SearchComponent::className(),
        'models' => [
            'article' => [
                'class' => \vintage\search\tests\models\Article::className(),
                'label' => 'Test label'
            ],
            'homeStaticPage' => [
                'class' => \vintage\search\tests\models\HomeStaticPage::className(),
            ],
        ]
    ]
];
