<?php
/**
 * @link https://github.com/Vintage-web-production/yii2-search
 * @copyright Copyright (c) 2017 Vintage Web Production
 * @license BSD 3-Clause License
 */

namespace vintage\search\tests\fixtures;

use yii\test\ActiveFixture;

/**
 * Fixture for Article model
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class ArticleFixture extends ActiveFixture
{
    /**
     * @inheritdoc
     */
    public $modelClass = 'vintage\search\tests\models\Article';
    /**
     * @inheritdoc
     */
    public $dataFile = '@data/article.php';
}
