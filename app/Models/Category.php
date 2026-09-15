<?php

/**
 * @author Ana Sofía Angarita Barrios
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;

class Category extends Model
{
    public $timestamps = true;

    protected $fillable = ['name', 'description'];

    protected $guarded = ['id'];

    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    public function setDescription(string $description): void
    {
        $this->attributes['description'] = $description;
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function getDescription(): string
    {
        return $this->attributes['description'];
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function getProducts(): Collection
    {
    return $this->products;
    }   

    public function getProductsCount(): int
    {
        return $this->products_count ?? $this->products()->count();
    }
}
