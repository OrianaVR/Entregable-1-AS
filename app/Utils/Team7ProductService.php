<?php

/**
 * @author Oriana
 */

namespace App\Utils;

use App\Exceptions\ExternalApiException;
use App\Interfaces\ExternalProductProvider;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class Team7ProductService implements ExternalProductProvider
{
    private const TIMEOUT_SECONDS = 5;

    private const LIST_KEYS = ['data', 'products', 'items'];

    private const NAME_KEYS = ['name', 'title'];

    private const BRAND_KEYS = ['brand'];

    private const DESCRIPTION_KEYS = ['description'];

    private const CATEGORY_KEYS = ['category'];

    private const IMAGE_KEYS = ['image', 'image_url', 'img'];

    private const PRICE_KEYS = ['price'];

    private const OFFER_PRICE_KEYS = ['offer_price', 'sale_price', 'discount_price'];

    private const CURRENCY_KEYS = ['currency'];

    private const URL_KEYS = ['url', 'link'];

    private const RULES = [
        'name' => ['required', 'string', 'max:255'],
        'brand' => ['nullable', 'string', 'max:255'],
        'description' => ['nullable', 'string'],
        'category' => ['nullable', 'string', 'max:255'],
        'image' => ['nullable', 'url:http,https'],
        'price' => ['required', 'numeric', 'min:0'],
        'offerPrice' => ['nullable', 'numeric', 'min:0'],
        'currency' => ['nullable', 'string', 'max:10'],
        'url' => ['nullable', 'url:http,https'],
    ];

    public function fetchProducts(): array
    {
        $apiUrl = (string) config('services.team7.api_url');

        if ($apiUrl === '') {
            throw new ExternalApiException('Team 7 API URL is not configured.');
        }

        try {
            $response = Http::acceptJson()->timeout(self::TIMEOUT_SECONDS)->get($apiUrl);
        } catch (ConnectionException $exception) {
            throw new ExternalApiException('Team 7 API is unreachable.', 0, $exception);
        }

        if ($response->failed()) {
            throw new ExternalApiException('Team 7 API responded with an error.');
        }

        $payload = $response->json();

        if (! is_array($payload)) {
            throw new ExternalApiException('Team 7 API returned an invalid JSON body.');
        }

        return $this->normalize($this->extractList($payload));
    }

    private function extractList(array $payload): array
    {
        if (array_is_list($payload)) {
            return $payload;
        }

        foreach (self::LIST_KEYS as $key) {
            if (isset($payload[$key]) && is_array($payload[$key])) {
                return $payload[$key];
            }
        }

        throw new ExternalApiException('Team 7 API returned an unexpected structure.');
    }

    private function normalize(array $rawProducts): array
    {
        $products = [];

        foreach ($rawProducts as $rawProduct) {
            if (! is_array($rawProduct)) {
                continue;
            }

            $validator = Validator::make($this->mapProduct($rawProduct), self::RULES);

            if ($validator->fails()) {
                continue;
            }

            $products[] = $this->buildProduct($validator->validated());
        }

        return $products;
    }

    private function mapProduct(array $rawProduct): array
    {
        $category = $this->firstValue($rawProduct, self::CATEGORY_KEYS);

        if (is_array($category)) {
            $category = $category['name'] ?? null;
        }

        return [
            'name' => $this->firstValue($rawProduct, self::NAME_KEYS),
            'brand' => $this->firstValue($rawProduct, self::BRAND_KEYS),
            'description' => $this->firstValue($rawProduct, self::DESCRIPTION_KEYS),
            'category' => $category,
            'image' => $this->firstValue($rawProduct, self::IMAGE_KEYS),
            'price' => $this->firstValue($rawProduct, self::PRICE_KEYS),
            'offerPrice' => $this->firstValue($rawProduct, self::OFFER_PRICE_KEYS),
            'currency' => $this->firstValue($rawProduct, self::CURRENCY_KEYS),
            'url' => $this->firstValue($rawProduct, self::URL_KEYS),
        ];
    }

    private function buildProduct(array $validated): array
    {
        $price = (float) $validated['price'];
        $offerPrice = isset($validated['offerPrice']) ? (float) $validated['offerPrice'] : null;

        return [
            'name' => $validated['name'],
            'brand' => $validated['brand'] ?? null,
            'description' => $validated['description'] ?? null,
            'category' => $validated['category'] ?? null,
            'image' => $validated['image'] ?? null,
            'price' => $price,
            'offerPrice' => $offerPrice,
            'hasOffer' => $offerPrice !== null && $offerPrice < $price,
            'currency' => $validated['currency'] ?? null,
            'url' => $validated['url'] ?? null,
        ];
    }

    private function firstValue(array $rawProduct, array $keys): mixed
    {
        foreach ($keys as $key) {
            if (isset($rawProduct[$key]) && $rawProduct[$key] !== '') {
                return $rawProduct[$key];
            }
        }

        return null;
    }
}
