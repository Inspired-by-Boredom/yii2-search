Search in Active Record models for Yii2
=======================================
This is component for searching in the Active Record models for Yii2 Framework.

[![Build Status](https://travis-ci.org/Vintage-web-production/yii2-search.svg?branch=master)](https://travis-ci.org/Vintage-web-production/yii2-search)
[![Total Downloads](https://poser.pugx.org/vintage/yii2-search/downloads)](https://packagist.org/packages/vintage/yii2-search)
[![Latest Stable Version](https://poser.pugx.org/vintage/yii2-search/v/stable)](https://packagist.org/packages/vintage/yii2-search)
[![Latest Unstable Version](https://poser.pugx.org/vintage/yii2-search/v/unstable)](https://packagist.org/packages/vintage/yii2-search)

Installation
------------
#### Install package
Run command
```
composer require vintage/yii2-search
```
or add
```json
"vintage/yii2-search": "dev-master"
```
to the require section of your composer.json.

Configuration
-------------
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
            ]
      ],
]
```
to the `models` option you should to add array with configuration of model where you need a search.
That classes should implements a `\vintage\search\interfaces\SearchInterface` interface
```php
/**
 * Article search model.
 * 
 * @property integer $id
 * @property string $title
 * @property string $short_description
 * @property string $content
 */
class ArticleSearch extends ActiveRecord implements \vintage\search\interfaces\SearchInterface
{
    /**
     * @inheritdoc
     */
    public function getSearchTitle() {
        return $this->title;
    }

    /**
     * @inheritdoc
     */
    public function getSearchDescription() {
        return $this->short_description;
    }

    /**
     * @inheritdoc
     */
    public function getSearchUrl() {
       return Url::toRoute['/news/default/index', 'id' => $this->id];
    }

   /**
    * @inheritdoc
    */
    public function getSearchFields() {
        return [
            'title',
            'short_description',
            'content',
        ];
    }
}
```

Usage
-----
Call method of search component with search query
```php
/* @var \vintage\search\data\SearchResult[] $result */
$result = Yii::$app->get('searcher')->search('some key words');
```
this method returns array of `\vintage\search\data\SearchResult` objects.

Licence
-------
[![License](https://poser.pugx.org/vintage/yii2-search/license)](https://packagist.org/packages/vintage/yii2-search)

This project is released under the terms of the BSD-3-Clause [license](LICENSE).

Copyright (c) 2017, [Vintage Web Production](https://vintage.com.ua/)