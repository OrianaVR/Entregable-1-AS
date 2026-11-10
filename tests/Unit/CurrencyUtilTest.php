<?php

/**
 * @author Nawal Oriana Valoyes Renteria
 */

namespace Tests\Unit;

use App\Utils\CurrencyUtil;
use Illuminate\Support\Facades\Cache;
use InvalidArgumentException;
use Tests\TestCase;

class CurrencyUtilTest extends TestCase
{
    public function test_usd_amounts_are_formatted_with_two_decimals(): void
    {
        $this->assertSame('$1,234.50 USD', CurrencyUtil::convertAndFormat(1234.5, 'USD'));
    }

    public function test_cop_amounts_use_the_cached_exchange_rate(): void
    {
        Cache::put('usd_to_cop_rate', 4000.0, 60);

        $this->assertSame('$10.000 COP', CurrencyUtil::convertAndFormat(2.5, 'COP'));
    }

    public function test_unsupported_currency_throws_an_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        CurrencyUtil::convertAndFormat(10.0, 'EUR');
    }
}
