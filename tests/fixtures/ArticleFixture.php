<?php

/*
 * This file is part of the yii2-search package.
 *
 * (c) Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace vintage\search\tests\fixtures;

use yii\test\ActiveFixture;

/**
 * Fixture for Article model.
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
