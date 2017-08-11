<?php
/**
 * @link https://github.com/Vintage-web-production/yii2-search
 * @copyright Copyright (c) 2017 Vintage Web Production
 * @license BSD 3-Clause License
 */

namespace vintage\search\data;

use yii\base\Object;
use yii\db\BaseActiveRecord;
use vintage\search\interfaces\SearchInterface;

/**
 * Model for store of search result.
 *
 * @property string $title
 * @property string $description
 * @property string $url
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class SearchResult extends Object
{
    /**
     * @var string
     */
    public $title;
    /**
     * @var string
     */
    public $description;
    /**
     * @var string
     */
    public $url;
    /**
     * @var integer
     */
    public $modelId;
    /**
     * @var string
     */
    public $modelName;


    /**
     * Building the result from Active Record object.
     *
     * @param BaseActiveRecord|SearchInterface $modelObject
     * @return SearchResult
     */
    public static function build($modelObject)
    {
        return new self([
            'modelId'       => $modelObject->getPrimaryKey(),
            'modelName'     => $modelObject::className(),
            'title'         => $modelObject->getSearchTitle(),
            'description'   => $modelObject->getSearchDescription(),
            'url'           => $modelObject->getSearchUrl(),
        ]);
    }

    /**
     * Multiply building of result from Active Record objects.
     *
     * @param BaseActiveRecord[]|SearchInterface[] $modelObjects
     * @return SearchResult[]
     */
    public static function buildMultiply($modelObjects)
    {
        $results = [];
        foreach ($modelObjects as $object) {
            $results[] = new self([
                'modelId'       => $object->getPrimaryKey(),
                'modelName'     => $object::className(),
                'title'         => $object->getSearchTitle(),
                'description'   => $object->getSearchDescription(),
                'url'           => $object->getSearchUrl()
            ]);
        }

        return $results;
    }

    /**
     * Method for sorting results of search by model name.
     *
     * @param SearchResult[] $searchResults
     * @return SearchResult[]
     */
    public static function sortByModel(array $searchResults)
    {
        $sorted = [];
        foreach($searchResults as $obj) {
            $sorted[$obj->modelName][] = $obj;
        }

        return $sorted;
    }
}
