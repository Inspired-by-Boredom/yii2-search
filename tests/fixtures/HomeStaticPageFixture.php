<?php
/**
 * @link https://github.com/Vintage-web-production/yii2-search
 * @copyright Copyright (c) 2017 Vintage Web Production
 * @license BSD 3-Clause License
 */

namespace vintage\search\tests\fixtures;

use yii\test\ActiveFixture;

/**
 * Fixture for HomeStaticPage model.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.1
 */
class HomeStaticPageFixture extends ActiveFixture
{
    /**
     * @inheritdoc
     */
    public $modelClass = 'vintage\search\tests\models\HomeStaticPage';
    /**
     * @inheritdoc
     */
    public $dataFile = '@data/home-static-page.php';
}
