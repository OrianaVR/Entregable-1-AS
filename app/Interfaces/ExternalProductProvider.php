<?php

/**
 * @author Nawal Oriana Valoyes Renteria
 */

namespace App\Interfaces;

interface ExternalProductProvider
{
    public function fetchProducts(): array;
}
