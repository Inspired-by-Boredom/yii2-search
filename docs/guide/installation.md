Installation
============

## Getting Composer package

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ composer require vintage/yii2-search
```

or add

```
vintage/yii2-search": "~1.0
````

to the `require` section of your `composer.json`.

## Configuring application

Add component to your application config

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

to the `models` option you should add array with configuration of model where you need a search.
These classes should implement a `\vintage\search\interfaces\SearchInterface` interface.