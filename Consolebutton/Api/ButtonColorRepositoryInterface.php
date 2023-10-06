<?php

declare(strict_types=1);

namespace Hibrido\Consolebutton\Api;

use Hibrido\Consolebutton\Api\Data\ButtonColorInterface;
use Hibrido\Consolebutton\Api\Data\ButtonColorSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;

interface ButtonColorRepositoryInterface
{
    /**
     * @param ButtonColorInterface $buttonColor
     * @return ButtonColorInterface
     * @throws CouldNotSaveException
     */
    public function save(ButtonColorInterface $buttonColor): ButtonColorInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return ButtonColorSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): ButtonColorSearchResultsInterface;
}
