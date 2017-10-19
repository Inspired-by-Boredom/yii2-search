<?php
/**
 * @link https://github.com/Vintage-web-production/yii2-search
 * @copyright Copyright (c) 2017 Vintage Web Production
 * @license BSD 3-Clause License
 */

namespace vintage\search\interfaces;

use yii\db\ActiveQueryInterface;

/**
 * Interface for search models with custom query.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.1
 */
interface CustomSearchInterface extends SearchInterface
{
    /**
     * In this method you should implement custom search query.
     *
     * @param ActiveQueryInterface $query
     * @param string $field Current search field.
     * @param string $searchQuery Search query.
     * @return ActiveQueryInterface
     */
    public function getQuery(ActiveQueryInterface $query, $field, $searchQuery);
}
