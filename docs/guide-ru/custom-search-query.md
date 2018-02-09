Кастомный запрос поиска для модели
==================================

Вы можете создать кастомный запрос для поиска в разных моделях.

Для этого нужно реализовать интерфейс `\vintage\search\interfaces\CustomSearchInterface` вместо
 `\vintage\search\interfaces\SearchInterface`

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
    public function getSearchTitle()
    {
        return 'Home page';
    }

    /**
     * @inheritdoc
     */
    public function getSearchDescription()
    {
        return $this->description;
    }

    /**
     * @inheritdoc
     */
    public function getSearchUrl()
    {
       return '/home';
    }

   /**
    * @inheritdoc
    */
    public function getSearchFields()
    {
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

данный интерфейс предоставляет метод `getQuery()`.

Он получает в качестве аргументов объект `ActiveQuery`, имя текучего поля для поиска и строку запроса.

В реализации метода вы должны вернуть объект `ActiveQuery`.