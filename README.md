Search in Active Record models for Yii2
=======================================
This is a component for searching in the Active Record models

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
            'class' => \vintage\search\SearchComponent::className(),
            'models' => [
                'article' => [
                    'class' => \common\models\Article::className(),
                    'label' => 'Articles'
                 ],
                 'products' => [
                    'class' => \common\models\Product::className(),
                    'label' => 'Shop products'
                 ],
                // ...
            ]
      ],
]
```
to the `models` option you should to add arrays with Active Record classes where you need a search.
That classes should implements a `\vintage\search\interfaces\SearchInterface` interface
```php
/**
 * @property integer $id
 * @property string $title
 * @property string $shortText
 * @property string $fullText
 * @property string $socialNetworksText
 */
class Article extends ActiveRecord implements \vintage\search\interfaces\SearchInterface
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
        return $this->shortText;
    }

    /**
     * @inheritdoc
     */
    public function getSearchUrl() {
       return Url::toRoute["/articles/$this->id"];
    }

   /**
    * @inheritdoc
    */
    public function getSearchFields() {
        return [
            'title',
            'shortText',
            'fullText'
        ];
    }
}
```

Usage
-----
Call method of search component with keyword
```php
$result = Yii::$app->get('searcher')->search('some key words');
```
this method returns to you array of `\vintage\search\data\SearchResult` objects