<p align="center">
    <a href="https://github.com/Vintage-web-production" target="_blank">
        <img src="https://avatars1.githubusercontent.com/u/25753250" height="100px">
    </a>
    <h1 align="center">Search in Active Record models for Yii2</h1>
</p>

[![Build Status](https://travis-ci.org/Vintage-web-production/yii2-search.svg?branch=master)](https://travis-ci.org/Vintage-web-production/yii2-search)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Vintage-web-production/yii2-search/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Vintage-web-production/yii2-search/?branch=master)
[![Total Downloads](https://poser.pugx.org/vintage/yii2-search/downloads)](https://packagist.org/packages/vintage/yii2-search)
[![Latest Stable Version](https://poser.pugx.org/vintage/yii2-search/v/stable)](CHANGELOG.md)
[![Latest Unstable Version](https://poser.pugx.org/vintage/yii2-search/v/unstable)](CHANGELOG.md)

This is component for searching in the Active Record models for Yii2 Framework.

Documentation is at [docs/guide/README.md](docs/guide/README.md).

Installation
------------

#### Install package

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ composer require vintage/yii2-search
```

or add

```
"vintage/yii2-search": "~2.0"
```

to the `require` section of your `composer.json`.

Usage
-----

Implement `\vintage\search\interfaces\SearchInterface` interface in Active Record models

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
    public function getSearchTitle()
    {
    
        return $this->title;
    }

    /**
     * @inheritdoc
     */
    public function getSearchDescription()
    {
        return $this->short_description;
    }

    /**
     * @inheritdoc
     */
    public function getSearchUrl()
    {
       return Url::toRoute['/news/default/index', 'id' => $this->id];
    }

   /**
    * @inheritdoc
    */
    public function getSearchFields()
    {
        return [
            'title',
            'short_description',
            'content',
        ];
    }
}
```

Call method of search component with a query

```php
/* @var \vintage\search\data\SearchResult[] $result */
$result = Yii::$app->get('searcher')->search('some query here');
```

this method returns array of `\vintage\search\models\SearchResult` objects.

Tests
-----
You can run tests with composer command

```
$ composer test
```

or using following command

```
$ codecept build && codecept run
```

Contributing
------------
For information about contributing please read [CONTRIBUTING.md](CONTRIBUTING.md).

Licence
-------
[![License](https://poser.pugx.org/vintage/yii2-search/license)](LICENSE)

This project is released under the terms of the BSD-3-Clause [license](LICENSE).