<?php
/**
 * @link https://github.com/Vintage-web-production/yii2-search
 * @copyright Copyright (c) 2017 Vintage Web Production
 * @license BSD 3-Clause License
 */

namespace vintage\search\interfaces;

/**
 * Interface for building the search result.
 *
 * @see \vintage\search\data\SearchResult
 *
 * You should implement this interface in your Active Record model.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
interface SearchInterface
{
    /**
     * Gets title.
     *
     * @return string This string will be inserted to the search result
     * to `title` field.
     */
    public function getSearchTitle();

    /**
     * Gets description.
     *
     * @return string This string will be inserted to the search result
     * to `description` field.
     */
    public function getSearchDescription();

    /**
     * Gets routes.
     *
     * @return string This string will be inserted to the search result
     * to `url` field.
     */
    public function getSearchUrl();

    /**
     * @return string[] Array of the field names
     * where will be implemented search in model.
     */
    public function getSearchFields();
}
