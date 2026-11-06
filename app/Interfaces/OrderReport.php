<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response;

interface OrderReport
{
    public function generate(Collection $orders): Response;
}
