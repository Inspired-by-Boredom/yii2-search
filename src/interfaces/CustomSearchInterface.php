<?php

/*
 * This file is part of the yii2-search package.
 *
 * (c) Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
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
     * @param ActiveQueryInterface  $query
     * @param string                $field Current search field.
     * @param string                $searchQuery Search query.
     *
     * @return ActiveQueryInterface
     */
    public function getQuery(ActiveQueryInterface $query, $field, $searchQuery);
}
