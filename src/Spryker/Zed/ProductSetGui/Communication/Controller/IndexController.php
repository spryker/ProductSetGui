<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductSetGui\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Orm\Zed\Company\Persistence\SpyCompanyQuery;
use Orm\Zed\Product\Persistence\SpyProductAbstract;
use Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributes;
use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Orm\Zed\Product\Persistence\SpyProductQuery;
use Orm\Zed\ProductBundle\Persistence\SpyProductBundleQuery;
use Orm\Zed\ProductReview\Persistence\SpyProductReviewQuery;
use Propel\Runtime\ActiveQuery\ModelCriteria;

/**
 * @method \Spryker\Zed\ProductSetGui\Communication\ProductSetGuiCommunicationFactory getFactory()
 * @method \Spryker\Zed\ProductSetGui\Persistence\ProductSetGuiQueryContainerInterface getQueryContainer()
 */
class IndexController extends AbstractController
{
    /**
     * @return void
     */
    protected function aclDemo(): void
    {
        /* Example for simple select query for the segment. */
        $query = SpyProductAbstractQuery::create()
            ->filterByIdProductAbstract(35);

        $this->showQuerySql($query);
        /************************************************/



//        /** WHEN QUERY WITHOUT ACL RESTRICTIONS TRYING TO JOIN THE TABLE WITH */
//        $query = SpyCompanyQuery::create()
//            ->useCompanyUserQuery()
//                ->joinCustomer()
//            ->endUse();
//
//        $this->showQuerySql($query);
//        /************************************************/



//        /* SUBQUERY CASE */
//        $query = SpyProductBundleQuery::create()
//            ->addSelectQuery(
//                SpyProductBundleQuery::create()
//                    ->useSpyProductRelatedByFkProductQuery()
//                    ->joinSpyProductAbstract()
//                    ->endUse()
//                    ->select('*')
//            );
//
//        $this->showQuerySql($query);
//       /************************************************/



//        /* WHEN TABLE INHERITS ACL RESTRICTION FROM SEVERAL SEGMENTS, WITH DIRECT RELATION, AND WITHOUT */
//        $query = SpyProductReviewQuery::create();
//
//        $this->showQuerySql($query);
//       /************************************************/


        // CASE WHEN WRITE OPERATIONS IS BLOCKED
//        $productAbstractEntity = new SpyProductAbstract();
//        $productAbstractEntity->setAttributes(new SpyProductAbstractLocalizedAttributes());
//        $productAbstractEntity->setSku('SKU-1');
//        $productAbstractEntity->save();
        /************************************************/

    }

    /**
     * @param \Propel\Runtime\ActiveQuery\ModelCriteria $query
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return void
     */
    protected function showQuerySql(ModelCriteria $query): void
    {
            $parameters = [];

            echo '<H1>WITHOUT ACL</H1>';
        $sqlWithoutAcl = $query->createSelectSql($parameters);
        echo \SqlFormatter::format($sqlWithoutAcl);

        $query->find();

        $sqlWithAcl = $query->createSelectSql($parameters);

        echo '<H1>WITH ACL</H1>';
        echo \SqlFormatter::format($sqlWithAcl);

        die();
    }

    /**
     * @return array
     */
    public function indexAction()
    {
        $this->aclDemo();
        $currentLocaleTransfer = $this->getFactory()->getLocaleFacade()->getCurrentLocale();
        $productSetTable = $this
            ->getFactory()
            ->createProductSetTable($currentLocaleTransfer);

        return $this->viewResponse([
            'productSetTable' => $productSetTable->render(),
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function tableAction()
    {
        $currentLocaleTransfer = $this->getFactory()->getLocaleFacade()->getCurrentLocale();
        $productTable = $this
            ->getFactory()
            ->createProductSetTable($currentLocaleTransfer);

        return $this->jsonResponse(
            $productTable->fetchData()
        );
    }
}
