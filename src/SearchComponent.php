<?php
/**
 * @link https://github.com/Vintage-web-production/yii2-search
 * @copyright Copyright (c) 2017 Vintage Web Production
 * @license BSD 3-Clause License
 */

namespace vintage\search;

use Yii;
use yii\base\Component;
use yii\base\Exception;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecordInterface;

use vintage\search\data\SearchResult;
use vintage\search\interfaces\SearchInterface;

/**
 * Component for search in Active Record models
 *
 * @property array $models
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class SearchComponent extends Component
{
    /**
     * @var array
     * Example:
     * ```php
     * 'models' => [
     *      'articles' => [
     *          'class' => Article::className(),
     *          'label' => 'Articles'
     *      ],
     *      'products' => [
     *          'class' => Product::className(),
     *          'label' => 'Shop products'
     *      ]
     * ]
     * ```
     */
    public $models = [];

    /**
     * @var string Current model class
     */
    protected $_currentModel;
    /**
     * @var SearchResult[] Array of the search results
     */
    protected $_result = [];


    /**
     * Method for searching
     *
     * Example
     * ```php
     * $result = Yii::$app->get('searcher')->search('query for searching');
     * ```
     *
     * @param string $query Keywords for search
     * @return SearchResult[] array of the result objects
     * @throws Exception
     * @throws InvalidConfigException
     */
    public function search($query) {
        foreach($this->models as $model) {
            /* @var ActiveRecordInterface|SearchInterface $ar */
            $ar = Yii::createObject($model['class']);

            if($ar instanceof SearchInterface && $ar instanceof ActiveRecordInterface) {
                $searchFields = $ar->getSearchFields();
                $activeQuery = $ar::find();

                foreach($searchFields as $field) {
                    if($ar->hasAttribute($field)) {
                        $activeQuery = $activeQuery->orWhere(['like', $field, $query]);
                    }
                    else {
                        $message = sprintf("Field `%s` not found in `%s` model", $field, $ar);
                        throw new Exception($message);
                    }
                }

                $modelObjects = $activeQuery->all();
                if($modelObjects !== null) {
                    $this->_currentModel = $ar;
                    $this->addToResult($modelObjects);
                }
            }
            else {
                throw new InvalidConfigException(
                    "$ar should be instance of `vintage\\search\\interfaces\\SearchInterface` and `yii\\db\\ActiveRecordInterface`"
                );
            }
        }

        return $this->_result;
    }

    /**
     * Getting model label by model name
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
     * Method for adding search result to the array of the results
     *
     * @param \yii\db\ActiveRecord[] $modelObjects
     */
    protected function addToResult($modelObjects) {
        $this->_result = SearchResult::buildMultiply($modelObjects);
    }
}
