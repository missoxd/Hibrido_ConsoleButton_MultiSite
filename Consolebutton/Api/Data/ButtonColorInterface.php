<?php

namespace Hibrido\Consolebutton\Api\Data;

interface ButtonColorInterface
{
    const ID = 'id';
    const COLOR = 'color';
    const STOREVIEW = 'storeview';

    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @param int $id
     * @return void
     */
    public function setId(int $id): void;

    /**
     * @return string
     */
    public function getColor(): string;

    /**
     * @param string $color
     * @return void
     */
    public function setColor(string $color): void;

    /**
     * @return int
     */
    public function getStoreview(): int;

    /**
     * @param int $storeview
     * @return void
     */
    public function setStoreview(int $storeview): void;
}
