<?php
/**
 * @link https://github.com/Vintage-web-production/yii2-search
 * @copyright Copyright (c) 2017 Vintage Web Production
 * @license BSD 3-Clause License
 */

namespace vintage\search\tests\unit\components;

use Yii;
use vintage\search\data\SearchResult;
use vintage\search\tests\unit\DbTestCase;
use vintage\search\tests\fixtures\ArticleFixture;
use vintage\search\tests\fixtures\HomeStaticPageFixture;
use vintage\search\tests\models\Article;
use vintage\search\tests\models\HomeStaticPage;

/**
 * Test case for Search component.
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


    /**
     * @inheritdoc
     */
    public function fixtures()
    {
        return [
            'article' => ArticleFixture::className(),
            'homeStaticPage' => HomeStaticPageFixture::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function _before()
    {
        parent::_before();
        $this->component = Yii::$app->get('searcher');
    }

    public function testSearchDefault()
    {
        $query = 'Test article #1';

        /** @var SearchResult[] $result */
        $result = $this->component->search($query);

        $expected = $query;
        $actual = $result[0]->title;

        $this->assertEquals($expected, $actual, 'Method must find string in database');

        $this->assertEquals(Article::className(), $result[0]->modelName, 'Result should contain a model name');
        $this->assertEquals(1, $result[0]->modelId, 'Result should contain a primary key of model');
    }

    public function testSearchCustom()
    {
        $query = 'page';

        /* @var SearchResult[] $result */
        $result = $this->component->search($query);

        $expected = 'This is home page';
        $actual = $result[0]->description;

        $this->assertEquals($expected, $actual, 'Method must find string in database');

        $this->assertEquals(HomeStaticPage::className(), $result[0]->modelName, 'Result should contain a model name');
        $this->assertEquals(3, $result[0]->modelId, 'Result should contain a primary key of model');
    }

    public function testGetModelLabel()
    {
        $expected = 'Test label';
        $actual = $this->component->getModelLabel('vintage\search\tests\models\Article');

        $this->assertEquals($expected, $actual, 'Method must return model label');
    }
}
