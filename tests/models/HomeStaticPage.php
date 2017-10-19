<?php
/**
 * @link https://github.com/Vintage-web-production/yii2-search
 * @copyright Copyright (c) 2017 Vintage Web Production
 * @license BSD 3-Clause License
 */

namespace vintage\search\tests\models;

use yii\db\ActiveQueryInterface;
use yii\db\ActiveRecord;
use vintage\search\interfaces\CustomSearchInterface;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $slug
 * @property string $description
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.1
 */
class HomeStaticPage extends ActiveRecord implements CustomSearchInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'static_page';
    }

    /**
     * @inheritdoc
     */
    public function getSearchTitle()
    {
        return 'Home Page';
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
