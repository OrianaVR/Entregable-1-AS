<?php

/**
 * @author Maria Laura Tafur Gomez
 */

namespace App\Utils;

use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use InvalidArgumentException;

class CurrencyUtil
{
    public static function getUsdToCopRate(): float
    {
        return Cache::remember('usd_to_cop_rate', now()->endOfDay(), function (): float {
            try {
                $response = Http::withToken(config('services.currency.api_key'))
                    ->withOptions(['verify' => config('services.currency.ca_bundle')])
                    ->timeout(3)
                    ->get('https://allratestoday.com/api/v1/central-bank/sfc/latest', [
                        'source' => 'USD',
                        'target' => 'COP'
                    ]);

                if ($response->successful()) {
                    $data = $response->json();

                    return (float) $data['rate'];
                }
            } catch (Exception $e) {
                return 4000.0;
            }

            return 4000.0;
        });
    }

    public static function convertAndFormat(float $basePriceUsd, string $currency): string
    {
        if ($currency === 'USD') {
            return '$' . number_format($basePriceUsd, 2, '.', ',') . ' USD';
        }

        if ($currency === 'COP') {
            $rate = self::getUsdToCopRate();
            $convertedPrice = $basePriceUsd * $rate;
            
            return '$' . number_format($convertedPrice, 0, ',', '.') . ' COP';
        }

        throw new InvalidArgumentException('Invalid currency requested: ' . $currency);
    }
}