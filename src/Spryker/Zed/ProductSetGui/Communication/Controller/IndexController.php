<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductSetGui\Communication\Controller;

use Orm\Zed\Acl\Persistence\Map\SpyAclEntityRuleTableMap;
use Orm\Zed\Acl\Persistence\SpyAclEntityRule;
use Orm\Zed\Customer\Persistence\Base\SpyCustomerQuery;
use Orm\Zed\Customer\Persistence\Map\SpyCustomerTableMap;
use Orm\Zed\Customer\Persistence\SpyCustomer;
use Orm\Zed\Customer\Persistence\SpyCustomerAddress;
use Orm\Zed\Customer\Persistence\SpyCustomerAddressQuery;
use Orm\Zed\Merchant\Persistence\Map\SpyMerchantTableMap;
use Orm\Zed\Merchant\Persistence\SpyMerchantQuery;
use Orm\Zed\MerchantProduct\Persistence\Base\SpyMerchantProductAbstract;
use Orm\Zed\MerchantProduct\Persistence\Map\SpyMerchantProductAbstractTableMap;
use Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstractQuery;
use Orm\Zed\MerchantSalesOrder\Persistence\Base\SpyMerchantSalesOrder;
use Orm\Zed\MerchantSalesOrder\Persistence\Map\SpyMerchantSalesOrderTableMap;
use Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderQuery;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Orm\Zed\Company\Persistence\SpyCompanyQuery;
use Orm\Zed\Product\Persistence\SpyProductAbstract;
use Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributes;
use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Orm\Zed\Product\Persistence\SpyProductQuery;
use Orm\Zed\ProductBundle\Persistence\SpyProductBundleQuery;
use Orm\Zed\ProductReview\Persistence\SpyProductReviewQuery;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\Kernel\Locator;
use SprykerTest\Zed\Sales\Helper\BusinessHelper;

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
//        $videoKingGroup = 3;
//        $sprykerGroup = 4;
//        $catalogViewerGroup = 5;
//        $catalogManagerGroup = 6;
//
//
//        $sprykerMerchant = 6;
//        $videoKingMerchant = 7;
//
//        $operations = [
//            SpyAclEntityRuleTableMap::COL_OPERATION_CREATE,
//            SpyAclEntityRuleTableMap::COL_OPERATION_UPDATE,
//            SpyAclEntityRuleTableMap::COL_OPERATION_READ
//        ];
//
//
//
//        $merchantEntityName = SpyMerchantTableMap::OM_CLASS;
//        $merchantProductAbstract = SpyMerchantProductAbstractTableMap::OM_CLASS;
//
//
//        foreach ([$videoKingGroup, $sprykerGroup] as $merchantGroup) {
//            $aclRule = new SpyAclEntityRule();
//            $aclRule->setOperation(SpyAclEntityRuleTableMap::COL_OPERATION_READ);
//            $aclRule->setScope(SpyAclEntityRuleTableMap::COL_SCOPE_PER_ITEM);
//            $aclRule->setEntity($merchantEntityName);
//            $aclRule->setFkAclGroup($merchantGroup);
//            $aclRule->save();
//        }
//
//        foreach ($operations as $o) {
//            $aclRule = new SpyAclEntityRule();
//            $aclRule->setOperation($o);
//            $aclRule->setScope(SpyAclEntityRuleTableMap::COL_SCOPE_INHERITED);
//            $aclRule->setEntity($merchantProductAbstract);
//            $aclRule->setFkAclGroup($catalogManagerGroup);
//            $aclRule->save();
//        }
//
//        $aclRule = new SpyAclEntityRule();
//        $aclRule->setOperation(SpyAclEntityRuleTableMap::COL_OPERATION_READ);
//        $aclRule->setScope(SpyAclEntityRuleTableMap::COL_SCOPE_INHERITED);
//        $aclRule->setEntity($merchantProductAbstract);
//        $aclRule->setFkAclGroup($catalogViewerGroup);
//        $aclRule->save();
//
//        die;


        $query = SpyMerchantProductAbstractQuery::create();
//        $query = SpyMerchantQuery::create();
        $this->debugQuery($query);
        $params = [];
        echo \SqlFormatter::format($query->createSelectSql($params));

        die;
        /* Example for simple select query for the segment. */
//        $query = SpyProductAbstractQuery::create()
//            ->filterByIdProductAbstract(35);
//
//        $this->showQuerySql($query);
        /************************************************/
        /** @var \Spryker\Zed\Acl\Business\AclFacade $aclFacade */
        $aclFacade = Locator::getInstance()->acl()->facade();

        $aclFacade->getEntityAccessRuleSet(1, SpyCustomerTableMap::OM_CLASS);


//        /** WHEN QUERY WITHOUT ACL RESTRICTIONS TRYING TO JOIN THE TABLE WITH */
//        $query = SpyCompanyQuery::create()
//            ->useCompanyUserQuery()
//                ->joinCustomer()
//            ->endUse();
//
//        $query = SpyCustomerQuery::create()->filterByIdCustomer_In([1, 2])->setFormatter(ModelCriteria::FORMAT_ON_DEMAND);

//        foreach ($query as $item) {
//            dd($item);
//        }

//        $result = $query->find()->toArray();
//        dd($result);
////        $query = SpyCustomerAddressQuery::create()->filterByFkCountry(1);
        $this->showQuerySql($query);
//        /************************************************/



        /* SUBQUERY CASE */
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
        $query = SpyProductReviewQuery::create();

        $this->showQuerySql($query);
//       /************************************************/


        // CASE WHEN WRITE OPERATIONS IS BLOCKED
//        $productAbstractEntity = new SpyProductAbstract();
//        $productAbstractEntity->setAttributes(new SpyProductAbstractLocalizedAttributes());
//        $productAbstractEntity->setSku('SKU-1');
//        $productAbstractEntity->save();
        /************************************************/

    }

    protected function debugQuery(ModelCriteria $query)
    {
        $result = $query->find()->toArray();
        $attrs = [];
        echo \SqlFormatter::format($query->createSelectSql($attrs));
        dd($result);
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
        xdebug_break();
        $result = $query->find();

        $sqlWithAcl = $query->createSelectSql($parameters);

        echo '<H1>WITH ACL</H1>';
        echo \SqlFormatter::format($sqlWithAcl);
        dd($result->toArray());
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

    private function create()
    {
        //        $videoKingGroup = 3;
//        $sprykerGroup = 4;
//        $catalogViewerGroup = 5;
//        $catalogManagerGroup = 6;
//
//
//        $sprykerMerchant = 6;
//        $videoKingMerchant = 7;
//
//        $operations = [
//            SpyAclEntityRuleTableMap::COL_OPERATION_CREATE,
//            SpyAclEntityRuleTableMap::COL_OPERATION_UPDATE,
//            SpyAclEntityRuleTableMap::COL_OPERATION_READ
//        ];
//
//
//
//        $merchantEntityName = SpyMerchantTableMap::OM_CLASS;
//        $merchantProductAbstract = SpyMerchantProductAbstractTableMap::OM_CLASS;
//
//
//        foreach ([$videoKingGroup, $sprykerGroup] as $merchantGroup) {
//            $aclRule = new SpyAclEntityRule();
//            $aclRule->setOperation(SpyAclEntityRuleTableMap::COL_OPERATION_READ);
//            $aclRule->setScope(SpyAclEntityRuleTableMap::COL_SCOPE_PER_ITEM);
//            $aclRule->setEntity($merchantEntityName);
//            $aclRule->setFkAclGroup($merchantGroup);
//            $aclRule->save();
//        }
//
//        foreach ($operations as $o) {
//            $aclRule = new SpyAclEntityRule();
//            $aclRule->setOperation($o);
//            $aclRule->setScope(SpyAclEntityRuleTableMap::COL_SCOPE_INHERITED);
//            $aclRule->setEntity($merchantProductAbstract);
//            $aclRule->setFkAclGroup($catalogManagerGroup);
//            $aclRule->save();
//        }
//
//        $aclRule = new SpyAclEntityRule();
//        $aclRule->setOperation(SpyAclEntityRuleTableMap::COL_OPERATION_READ);
//        $aclRule->setScope(SpyAclEntityRuleTableMap::COL_SCOPE_INHERITED);
//        $aclRule->setEntity($merchantProductAbstract);
//        $aclRule->setFkAclGroup($catalogViewerGroup);
//        $aclRule->save();
//
//        die;
    }
}
