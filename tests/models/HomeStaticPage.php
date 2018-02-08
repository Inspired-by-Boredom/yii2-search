<?php

/*
 * This file is part of the yii2-search package.
 *
 * (c) Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
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
