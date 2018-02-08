<?php

/*
 * This file is part of the yii2-search package.
 *
 * (c) Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace vintage\search\tests\unit;

use yii\test\FixtureTrait;

/**
 * Base test case for unit tests with fixtures support.
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
