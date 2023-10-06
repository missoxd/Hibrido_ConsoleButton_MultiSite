<?php
/** @noinspection PhpMissingReturnTypeInspection */

declare(strict_types=1);

namespace Hibrido\Consolebutton\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface ButtonColorSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return ButtonColorInterface[]
     */
    public function getItems();

    /**
     * @param ButtonColorInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
