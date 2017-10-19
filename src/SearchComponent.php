<?php
/**
 * @link https://github.com/Vintage-web-production/yii2-search
 * @copyright Copyright (c) 2017 Vintage Web Production
 * @license BSD 3-Clause License
 */

namespace vintage\search;

use vintage\search\interfaces\CustomSearchInterface;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\db\BaseActiveRecord;
use yii\helpers\ArrayHelper;
use vintage\search\data\SearchResult;
use vintage\search\interfaces\SearchInterface;

/**
 * Component for search in Active Record models.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class SearchComponent extends Component
{
    /**
     * @var array Array with configuration of models for search.
     * @example
     * ```php
     * 'models' => [
     *      'articles' => [
     *          'class' => Article::class,
     *          'label' => 'Articles',
     *      ],
     *      'products' => [
     *          'class' => Product::class,
     *          'label' => 'Shop products',
     *      ],
     *      // ...
     * ]
     * ```
     */
    public $models = [];

    /**
     * @var SearchResult[] Array of the search result.
     */
    protected $result = [];


    /**
     * Method for searching.
     *
     * @example
     * ```php
     * $result = Yii::$app->get('searcher')->search('query for searching');
     * ```
     *
     * @param string $query Keywords for search.
     * @return SearchResult[] Array of the result objects.
     * @throws \Exception
     * @throws InvalidConfigException
     */
    public function search($query)
    {
        foreach($this->models as $model) {
            /* @var BaseActiveRecord|SearchInterface $searchModel */
            $searchModel = Yii::createObject($model['class']);

            if(!$this->isSearchModel($searchModel)) {
                throw new InvalidConfigException(
                    $model['class'] . 'should be instance of `\vintage\search\interfaces\SearchInterface` and `\yii\db\ActiveRecordInterface`'
                );
            }

            $activeQuery = $searchModel::find();
            foreach($searchModel->getSearchFields() as $field) {
                if(!$searchModel->hasAttribute($field)) {
                    throw new \Exception(sprintf("Field `%s` not found in `%s` model", $field, $model['class']));
                }

                $activeQuery = ($searchModel instanceof CustomSearchInterface)
                    ? $searchModel->getQuery($activeQuery, $field, $query)
                    : $activeQuery->orWhere(['like', $field, $query]);
            }
            $this->addToResult($activeQuery->all());
        }
        return $this->result;
    }

    /**
     * Getting model label by model name.
     *
     * @param string $modelName
     * @return null|string
     */
    public function getModelLabel($modelName)
    {
        foreach($this->models as $model) {
            if($model['class'] == $modelName) {
                return $model['label'];
            }
        }
        return null;
    }

    /**
     * Method for adding iteration result to final result.
     *
     * @param \yii\db\ActiveRecord[] $foundModels
     */
    protected function addToResult($foundModels)
    {
        if ($foundModels !== null) {
            $tmp = SearchResult::buildMultiply($foundModels);
            $this->result = ArrayHelper::merge($tmp, $this->result);
        }
    }

    /**
     * Check whether given model is search model.
     *
     * @param Model $model
     * @return bool `true` if given model is search model.
     * @since 1.1
     */
    protected function isSearchModel(Model $model)
    {
        return $model instanceof BaseActiveRecord
            && $model instanceof SearchInterface;
    }
}
