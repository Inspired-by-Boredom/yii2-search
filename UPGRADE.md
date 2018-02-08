Upgrading Instructions
======================

This file contains the upgrade notes. These notes highlight changes that could break your
application when you upgrade the package from one version to another.

Upgrade from 1.x to 2.x
-----------------------

* Changed minimum Yii version from `^2.0.0` to `^2.0.13`

* Moved `vintage\search\data\SearchResult` class to `vintage\search\models\SearchResult`
namespace

* Removed unused dev packages codeception/verify and codeception/specify