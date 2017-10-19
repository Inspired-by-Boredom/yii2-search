Продвинутое использование
=========================

Использование кастомного запроса для модели
-------------------------------------------

Вместо `\vintage\search\interfaces\SearchInterface`
вам нужно реализовать интерфейс `\vintage\search\interfaces\CustomSearchInterface`.
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
этот интерфейс предоставляет метод `getQuery()`. Он получает `ActiveQuery` объект, текущее поле для поиска и поисковой запрос.
Вы можете построить нужный вам запрос. После вы должны вернуть объект `ActiveQuery`.