<?php

declare(strict_types=1);

namespace Hibrido\Consolebutton\Api;

interface ButtonColorManagementInterface
{
    /**
     * @param int $storeview
     * @param string $color
     * @return bool
     */
    public function changeButtonColorForStoreview(int $storeview, string $color): bool;
}
