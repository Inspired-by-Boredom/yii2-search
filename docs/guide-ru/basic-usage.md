Базовое использование
=====================

Реализуйте интерфейс `\vintage\search\interfaces\SearchInterface` в моделях Active Record

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

Вызовите метод компонента для поиска с запросом

```php
/* @var \vintage\search\data\SearchResult[] $result */
$result = Yii::$app->get('searcher')->search('запрос тут');
```

этот метод возвращает массив объектов модели `\vintage\search\models\SearchResult`.