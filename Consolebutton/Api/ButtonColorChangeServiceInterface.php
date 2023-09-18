<?php

namespace Hibrido\Consolebutton\Api;

interface ButtonColorChangeServiceInterface
{
    /**
     * @param int $storeview
     * @param string $color
     * @return bool
     */
    public function execute(int $storeview, string $color): bool;
}
