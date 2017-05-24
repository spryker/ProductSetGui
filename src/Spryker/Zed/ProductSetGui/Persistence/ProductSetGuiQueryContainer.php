<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductSetGui\Persistence;

use Generated\Shared\Transfer\LocaleTransfer;
use Orm\Zed\Product\Persistence\Map\SpyProductAbstractLocalizedAttributesTableMap;
use Orm\Zed\ProductSet\Persistence\Map\SpyProductAbstractSetTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \Spryker\Zed\ProductSetGui\Persistence\ProductSetGuiPersistenceFactory getFactory()
 */
class ProductSetGuiQueryContainer extends AbstractQueryContainer implements ProductSetGuiQueryContainerInterface
{

    const COL_ALIAS_NAME = 'name';
    const COL_ALIAS_POSITION = 'position';

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery
     */
    public function queryProductAbstract(LocaleTransfer $localeTransfer)
    {
        $query = $this->getFactory()
            ->createProductAbstractQuery()
            ->useSpyProductAbstractLocalizedAttributesQuery()
                ->filterByFkLocale($localeTransfer->getIdLocale())
            ->endUse()
            ->withColumn(SpyProductAbstractLocalizedAttributesTableMap::COL_NAME, self::COL_ALIAS_NAME);

        return $query;
    }

    /**
     * @api
     *
     * @param int $idProductSet
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery
     */
    public function queryProductAbstractByIdProductSet($idProductSet, LocaleTransfer $localeTransfer)
    {
        $query = $this->getFactory()
            ->createProductAbstractQuery()
            ->useSpyProductAbstractSetQuery()
                ->filterByFkProductSet($idProductSet)
            ->endUse()
            ->useSpyProductAbstractLocalizedAttributesQuery()
                ->filterByFkLocale($localeTransfer->getIdLocale())
            ->endUse()
            ->withColumn(SpyProductAbstractLocalizedAttributesTableMap::COL_NAME, self::COL_ALIAS_NAME)
            ->withColumn(SpyProductAbstractSetTableMap::COL_POSITION, self::COL_ALIAS_POSITION);

        return $query;
    }

}
