<?php

/**
 * @author Oriana
 */

namespace App\Interfaces;

interface ExternalProductProvider
{
    public function fetchProducts(): array;
}
