Basic usage
===========
> If you want use all features - read a [advanced usage](advanced-usage.md) guide.

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
            ],
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