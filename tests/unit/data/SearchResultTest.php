<?php
/**
 * @link https://github.com/Vintage-web-production/yii2-search
 * @copyright Copyright (c) 2017 Vintage Web Production
 * @license BSD 3-Clause License
 */

namespace vintage\search\tests\unit\data;

use vintage\search\tests\models\Article;
use vintage\search\tests\unit\TestCase;
use vintage\search\data\SearchResult;

/**
 * Test case for SearchResult class.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class SearchResultTest extends TestCase
{
    public function testInstanceOf()
    {
        $this->assertInstanceOf(
            'yii\base\Configurable',
            new SearchResult(),
            'Class should be instance of `yii\base\Configurable`'
        );
    }

    public function testBuild()
    {
        $expectedModelId = 1;
        $expectedModelName = 'vintage\search\tests\models\Article';
        $expectedTitle = 'Test title';
        $expectedDescription = 'Test description';
        $expectedUrl = '/articles/1';

        $model = new Article([
            'id' => $expectedModelId,
            'title' => $expectedTitle,
            'shortText' => $expectedDescription
        ]);

        $object = SearchResult::build($model);

        $this->assertEquals($expectedModelId, $object->modelId, 'Model id is wrong');
        $this->assertEquals($expectedModelName, $object->modelName, 'Model name is wrong');
        $this->assertEquals($expectedTitle, $object->title, 'Title is wrong');
        $this->assertEquals($expectedDescription, $object->description, 'Description is wrong');
        $this->assertEquals($expectedUrl, $object->url, 'URL is wrong');
    }
}
