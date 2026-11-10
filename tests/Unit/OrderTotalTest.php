<?php

/**
 * @author Nawal Oriana Valoyes Renteria
 */

namespace Tests\Unit;

use App\Models\Item;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class OrderTotalTest extends TestCase
{
    private function buildItem(int $quantity, float $price): Item
    {
        $item = new Item;
        $item->setQuantity($quantity);
        $item->setPrice($price);

        return $item;
    }

    public function test_order_total_sums_price_times_quantity_of_every_item(): void
    {
        $order = new Order;
        $order->setRelation('items', new Collection([
            $this->buildItem(2, 10.50),
            $this->buildItem(3, 5.00),
        ]));

        $this->assertEqualsWithDelta(36.0, $order->getTotal(), 0.001);
    }

    public function test_order_total_is_zero_when_order_has_no_items(): void
    {
        $order = new Order;
        $order->setRelation('items', new Collection);

        $this->assertEqualsWithDelta(0.0, $order->getTotal(), 0.001);
    }
}
