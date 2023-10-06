<?php

declare(strict_types=1);

namespace Hibrido\Consolebutton\Api\Data;

interface ButtonColorInterface
{
    const ID = 'id';
    const COLOR = 'color';
    const STOREVIEW = 'storeview';

    /**
     * @return mixed
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function getId();

    /**
     * @param mixed $value
     * @return $this
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function setId(mixed $value);

    /**
     * @return ?string
     */
    public function getColor(): ?string;

    /**
     * @param string $color
     * @return static
     */
    public function setColor(string $color): static;

    /**
     * @return ?int
     */
    public function getStoreview(): ?int;

    /**
     * @param int $storeview
     * @return static
     */
    public function setStoreview(int $storeview): static;
}
