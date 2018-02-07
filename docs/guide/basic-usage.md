Basic usage
===========

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

this method returns array of `\vintage\search\data\SearchResult` objects.