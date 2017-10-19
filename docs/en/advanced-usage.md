Advanced usage
==============

Using custom query in model
---------------------------

Instead `\vintage\search\interfaces\SearchInterface`
you should implement `\vintage\search\interfaces\CustomSearchInterface` interface.
```php
/**
 * Home static page search model.
 * 
 * @property integer $id
 * @property string $slug
 * @property string $description
 */
class ArticleSearch extends ActiveRecord implements \vintage\search\interfaces\CustomSearchInterface
{
    /**
     * @inheritdoc
     */
    public function getSearchTitle() {
        return 'Home page';
    }

    /**
     * @inheritdoc
     */
    public function getSearchDescription() {
        return $this->description;
    }

    /**
     * @inheritdoc
     */
    public function getSearchUrl() {
       return '/home';
    }

   /**
    * @inheritdoc
    */
    public function getSearchFields() {
        return [
            'description',
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function getQuery(ActiveQueryInterface $query, $field, $searchQuery)
    {
        return $query->orWhere([
            'and',
            ['like', $field, $searchQuery],
            ['slug' => 'home']
        ]);
    }
}
```
it interface provides `getQuery()` method. It takes `ActiveQuery`, current search field and user search query.
You can build custom query. Then you should return `ActiveQuery` object.