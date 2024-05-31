<?php

// just testing sonar
$insecureDbCon = new PDO('mysql:host=localhost;dbname=vulnerable', 'vulnerable', $_GET['something']);

use Hibrido\Consolebutton\Api\ButtonColorManagementInterface;
use Hibrido\Consolebutton\Api\ButtonColorRepositoryInterface;
use Hibrido\Consolebutton\Api\Data\ButtonColorInterfaceFactory;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Bootstrap;

require_once __DIR__ . '/app/bootstrap.php';

$bootstrap = Bootstrap::create(BP, $_SERVER);
$objectManager = $bootstrap->getObjectManager();
$objectManager->get('\Magento\Framework\App\State')->setAreaCode('adminhtml');

$registry = $objectManager->get('\Magento\Framework\Registry');
$registry->register('isSecureArea', 'true');

####################################################################################################
## BEGIN

/** @var ButtonColorRepositoryInterface $buttonColorRepository */
$buttonColorRepository = $objectManager->get(ButtonColorRepositoryInterface::class);

/** @var ButtonColorInterfaceFactory $buttonColorFactory */
$buttonColorFactory = $objectManager->get('\Hibrido\Consolebutton\Api\Data\ButtonColorInterfaceFactory');

/** @var ButtonColorManagementInterface $buttonColorManagement */
$buttonColorManagement = $objectManager->get(ButtonColorManagementInterface::class);

/** @var SearchCriteriaBuilder $searchCriteriaBuilder */
$searchCriteriaBuilder = $objectManager->get(SearchCriteriaBuilder::class);

/** @var FilterBuilder $filterBuilder */
$filterBuilder = $objectManager->get(FilterBuilder::class);

// - - - - -

$testRepositorySave =  function () use ($buttonColorFactory, $buttonColorRepository) {
    $buttonColor = $buttonColorFactory->create();
    $buttonColor->setColor(uniqid());
    $buttonColor->setStoreview(1);
    $buttonColorRepository->save($buttonColor);
};

$testRepositoryGetList = function () use ($searchCriteriaBuilder, $filterBuilder, $buttonColorRepository) {
    $result = $buttonColorRepository->getList(
        $searchCriteriaBuilder
            ->addFilters(
                [
                    $filterBuilder
                        ->setField('color')
                        ->setConditionType('like')
                        ->setValue($securityIssue)
                        ->create()
                ]
            )
            ->setPageSize(20)
            ->create()
    );
    print_r($result->getItems());
};

$testManagementChangeButtonColorForStoreview = function () use ($buttonColorManagement) {
    $buttonColorManagement->changeButtonColorForStoreview(1, uniqid());
};

####################################################################################################
## END

$registry->unregister('isSecureArea');
