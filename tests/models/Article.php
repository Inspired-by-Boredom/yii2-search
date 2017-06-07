<?php
/**
 * @link https://github.com/Vintage-web-production/yii2-search
 * @copyright Copyright (c) 2017 Vintage Web Production
 * @license BSD 3-Clause License
 */

namespace vintage\search\tests\models;

use yii\db\ActiveRecord;

use vintage\search\interfaces\SearchInterface;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $title
 * @property string $shortText
 * @property string $fullText
 * @property string $socialNetworksText
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class Article extends ActiveRecord implements SearchInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

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
        return $this->shortText;
    }

    /**
     * @inheritdoc
     */
    public function getSearchUrl()
    {
        return "/articles/$this->id";
    }

    /**
     * @inheritdoc
     */
    public function getSearchFields()
    {
        return [
            'title',
            'shortText',
            'fullText'
        ];
    }
}
