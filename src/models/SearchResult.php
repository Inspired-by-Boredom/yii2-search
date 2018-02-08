<?php

/*
 * This file is part of the yii2-search package.
 *
 * (c) Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace vintage\search\models;

use yii\base\BaseObject;

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
class SearchResult extends BaseObject
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
     * @param \yii\db\BaseActiveRecord|\vintage\search\interfaces\SearchInterface $modelObject
     *
     * @return SearchResult
     */
    public static function build($modelObject)
    {
        return new self([
            'modelId' => $modelObject->getPrimaryKey(),
            'modelName' => $modelObject::className(),
            'title' => $modelObject->getSearchTitle(),
            'description' => $modelObject->getSearchDescription(),
            'url' => $modelObject->getSearchUrl(),
        ]);
    }

    /**
     * Multiply building of result from Active Record objects.
     *
     * @param \yii\db\BaseActiveRecord[]|\vintage\search\interfaces\SearchInterface[] $modelObjects
     *
     * @return SearchResult[]
     */
    public static function buildMultiply($modelObjects)
    {
        $results = [];

        foreach ($modelObjects as $object) {
            $results[] = static::build($object);
        }

        return $results;
    }

    /**
     * Method for sorting results of search by model name.
     *
     * @param SearchResult[] $searchResults
     *
     * @return SearchResult[]
     */
    public static function sortByModel(array $searchResults)
    {
        $sorted = [];

        foreach ($searchResults as $obj) {
            $sorted[$obj->modelName][] = $obj;
        }

        return $sorted;
    }
}
