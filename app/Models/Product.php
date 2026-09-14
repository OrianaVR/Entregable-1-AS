<?php

/**
 * @author Ana Sofía Angarita Barrios
 *
 * @property int $id
 * @property string $name
 * @property string $brand
 * @property float $price
 * @property string $description
 * @property int $stock
 * @property string $image
 * @property int $category_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \App\Models\Category $category
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Item> $items
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Review> $reviews
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    public $timestamps = true;

    protected $fillable = ['name', 'brand', 'price', 'description', 'stock', 'image', 'category_id'];

    protected $guarded = ['id'];

    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    public function setBrand(string $brand): void
    {
        $this->attributes['brand'] = $brand;
    }

    public function setPrice(float $price): void
    {
        $this->attributes['price'] = $price;
    }

    public function setDescription(string $description): void
    {
        $this->attributes['description'] = $description;
    }

    public function setStock(int $stock): void
    {
        $this->attributes['stock'] = $stock;
    }

    public function setImage(string $image): void
    {
        $this->attributes['image'] = $image;
    }

    public function setCategoryId(int $categoryId): void
    {
        $this->attributes['category_id'] = $categoryId;
    }

    public function setFeatured(bool $featured): void
    {
    $this->attributes['featured'] = $featured;
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function getBrand(): string
    {
        return $this->attributes['brand'];
    }

    public function getPrice(): float
    {
        return $this->attributes['price'];
    }

    public function getDescription(): string
    {
        return $this->attributes['description'];
    }

    public function getStock(): int
    {
        return $this->attributes['stock'];
    }

    public function getImage(): string
    {
        return $this->attributes['image'];
    }

    public function getCategoryId(): int
    {
        return $this->attributes['category_id'];
    }

    public function getFeatured(): bool
    {
    return $this->attributes['featured'];
    }


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function getReviews(): Collection
    {
        return $this->reviews;
    }



}
