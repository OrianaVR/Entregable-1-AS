<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Utils;

use App\Models\Order;
use Illuminate\Support\Collection;

class OrderUtil
{
    public static function countByState(Collection $orders, string $state): int
    {
        return $orders->filter(fn (Order $order): bool => $order->getState() === $state)->count();
    }

    public static function itemsOf(Collection $orders): Collection
    {
        return $orders->flatMap(fn (Order $order): Collection => $order->getItems());
    }

    public static function formatUnitPrices(Collection $items, string $currency): array
    {
        $formatted = [];

        foreach ($items as $item) {
            $formatted[$item->getId()] = CurrencyUtil::convertAndFormat($item->getPrice(), $currency);
        }

        return $formatted;
    }

    public static function formatSubtotals(Collection $items, string $currency): array
    {
        $formatted = [];

        foreach ($items as $item) {
            $formatted[$item->getId()] = CurrencyUtil::convertAndFormat($item->getSubtotal(), $currency);
        }

        return $formatted;
    }

    public static function formatTotals(Collection $orders, string $currency): array
    {
        $formatted = [];

        foreach ($orders as $order) {
            $formatted[$order->getId()] = CurrencyUtil::convertAndFormat($order->getTotal(), $currency);
        }

        return $formatted;
    }
}
