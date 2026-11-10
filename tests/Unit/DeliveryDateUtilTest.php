<?php

/**
 * @author Nawal Oriana Valoyes Renteria
 */

namespace Tests\Unit;

use App\Utils\DeliveryDateUtil;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class DeliveryDateUtilTest extends TestCase
{
    protected function tearDown(): void
    {
        Carbon::setTestNow();

        parent::tearDown();
    }

    public function test_estimated_date_adds_eight_business_days_from_a_monday(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-11-09 10:00:00'));

        $this->assertSame('2026-11-19', DeliveryDateUtil::estimatedDate());
    }

    public function test_estimated_date_skips_weekends_when_ordering_on_a_friday(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-11-13 10:00:00'));

        $estimatedDate = Carbon::parse(DeliveryDateUtil::estimatedDate());

        $this->assertSame('2026-11-25', $estimatedDate->format('Y-m-d'));
        $this->assertFalse($estimatedDate->isWeekend());
    }
}
