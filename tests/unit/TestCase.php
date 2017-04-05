<?php
/**
 * @link https://github.com/Vintage-web-production/yii2-search
 * @copyright Copyright (c) 2017 Vintage Web Production
 * @license BSD 3-Clause License
 */

namespace tests\unit;

use yii\test\FixtureTrait;

/**
 * Base test case for unit tests
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class TestCase extends \Codeception\Test\Unit
{
    use FixtureTrait;

    /**
     * @var \UnitTester
     */
    protected $tester;
}
