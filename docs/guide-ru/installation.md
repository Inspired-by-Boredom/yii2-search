Установка
=========

## Получение с помощью Composer

Предпочтительный способ установки расширения через [composer](http://getcomposer.org/download/).

Для этого запустите

```
$ composer require vintage/yii2-search
```

или добавьте

```
vintage/yii2-search": "~1.0
````

в секцию `require` вашего `composer.json`.

## Настройка приложения

Добавьте компонент в конфиг вашего приложения

```php
'components' => [
      // ...
      'searcher' => [
            'class' => \vintage\search\SearchComponent::class,
            'models' => [
                'article' => [
                    'class' => \common\models\Article::class,
                    'label' => 'Articles',
                 ],
                 'products' => [
                    'class' => \common\models\Product::class,
                    'label' => 'Shop products',
                 ],
                // ...
            ],
      ],
]
```

в опцию `models` вы должны добавить массив с конфигурацией моделе в которых нужно делать поиск.
Эти модели должны реализовывать интерфейс `\vintage\search\interfaces\SearchInterface`.