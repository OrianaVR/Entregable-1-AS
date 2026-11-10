<?php

/**
 * @author Nawal Oriana Valoyes Renteria
 */

namespace Tests\Unit;

use App\Exceptions\ExternalApiException;
use App\Utils\Team7ProductService;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class Team7ProductServiceTest extends TestCase
{
    private const API_URL = 'https://team7.test/api/products';

    protected function setUp(): void
    {
        parent::setUp();

        config(['services.team7.api_url' => self::API_URL]);
    }

    public function test_valid_products_are_normalized_and_invalid_ones_are_discarded(): void
    {
        Http::fake([
            self::API_URL => Http::response([
                'data' => [
                    ['name' => 'Vitamin C Serum', 'price' => 32.5, 'offer_price' => 24.9],
                    ['name' => 'Daily Moisturizer', 'price' => '18'],
                    ['name' => 'Product without price'],
                ],
            ], 200),
        ]);

        $products = (new Team7ProductService)->fetchProducts();

        $this->assertCount(2, $products);
        $this->assertSame('Vitamin C Serum', $products[0]['name']);
        $this->assertTrue($products[0]['hasOffer']);
        $this->assertSame(18.0, $products[1]['price']);
        $this->assertFalse($products[1]['hasOffer']);
    }

    public function test_an_unsuccessful_api_response_throws_an_exception(): void
    {
        Http::fake([
            self::API_URL => Http::response([], 500),
        ]);

        $this->expectException(ExternalApiException::class);

        (new Team7ProductService)->fetchProducts();
    }
}
