Базовое использование
=====================
> Если вы хотите использовать все возможности - прочтите [продвинутуе использование](advanced-usage.md).

Настройка
---------

Добавьте компонент в конфиг приложения
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
в опцию `models` вам нужно добавить модели в которых нужно делать поиск.
Эти модели должны реализовать интерфейс `\vintage\search\interfaces\SearchInterface`
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

В нужном месте вызовите метод компонента и передайте туд запрос
```php
/* @var \vintage\search\data\SearchResult[] $result */
$result = Yii::$app->get('searcher')->search('some key words');
```
этот метод вернёт массив объектов `\vintage\search\data\SearchResult`.