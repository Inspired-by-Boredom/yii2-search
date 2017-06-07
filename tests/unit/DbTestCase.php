<?php
/**
 * @link https://github.com/Vintage-web-production/yii2-search
 * @copyright Copyright (c) 2017 Vintage Web Production
 * @license BSD 3-Clause License
 */

namespace vintage\search\tests\unit;

use yii\test\FixtureTrait;

/**
 * Base test case for unit tests with database
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class DbTestCase extends TestCase
{
    use FixtureTrait;


    public function _before()
    {
        $this->loadFixtures();
    }

    public function _after()
    {
        $this->unloadFixtures();
    }
}
