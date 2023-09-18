<?php

namespace Hibrido\Consolebutton\Api;

interface ButtonColorRepositoryInterface
{
    /**
     * @return array Lista de store views.
     */
    public function getAllStoreviews();

    /**
     * @return array Lista de cores.
     */
    public function getAllColor();

    /**
     * @param string $storeView A store view para a qual a cor será atribuída.
     * @param string $newColor A nova cor em formato hexadecimal.
     */
    public function saveColor($storeView, $newColor);

    /**
     * @param string $storeView A store view a ser verificada.
     * @return bool Retorna verdadeiro se a store view existir, falso caso contrário.
     */
    public function storeviewExists($storeView);
}
