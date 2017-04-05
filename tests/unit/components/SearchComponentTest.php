<?php
/**
 * @link https://github.com/Vintage-web-production/yii2-search
 * @copyright Copyright (c) 2017 Vintage Web Production
 * @license BSD 3-Clause License
 */

namespace tests\unit\components;

use Yii;

use tests\unit\DbTestCase;
use tests\fixtures\ArticleFixture;

use vintage\search\data\SearchResult;

/**
 * Test case for Search component
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class SearchComponentTest extends DbTestCase
{
    /**
     * @var \vintage\search\SearchComponent
     */
    private $component = null;


    public function fixtures()
    {
        return [
            'article' => [
                'class' => ArticleFixture::className()
            ]
        ];
    }

    public function _before()
    {
        parent::_before();
        $this->component = Yii::$app->get('searcher');
    }

    public function testSearch()
    {
        $query = 'Test article #1';

        /** @var SearchResult[] $result */
        $result = $this->component->search($query);

        $expected = $query;
        $actual = $result[0]->title;

        $this->assertEquals($expected, $actual, 'Method must find string in database');

        $this->assertEquals('tests\models\Article', $result[0]->modelName, 'Result should contain a model name');
        $this->assertEquals(1, $result[0]->modelId, 'Result should containt a primary key of model');
    }

    public function testGetModelLabel()
    {
        $expected = 'Test label';
        $actual = $this->component->getModelLabel('tests\models\Article');

        $this->assertEquals($expected, $actual, 'Method must return model label');
    }
}
