<?php

// AUTHOR: Maria Laura Tafur Gomez

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

class Order extends Model
{
    /**
     * ORDER ATTRIBUTES
     *
     * @property int $id
     * @property string $address
     * @property string $state
     * @property string $delivery_date
     * @property int $user_id
     * @property User $user
     * @property Carbon $created_at
     * @property Carbon $updated_at
     */
    public $timestamps = true;

    protected $fillable = ['address', 'state', 'delivery_date', 'user_id'];

    protected $guarded = ['id'];

    public function setAddress(string $address): void
    {
        $this->attributes['address'] = $address;
    }

    public function setState(string $state): void
    {
        $this->attributes['state'] = $state;
    }

    public function setDeliveryDate(string $deliveryDate): void
    {
        $this->attributes['delivery_date'] = $deliveryDate;
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getAddress(): string
    {
        return $this->attributes['address'];
    }

    public function getState(): string
    {
        return $this->attributes['state'];
    }

    public function getDeliveryDate(): string
    {
        return $this->attributes['delivery_date'];
    }

    public function getCreatedAt(): Carbon
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->updated_at;
    }

    public function getUserId(): int
    {
        return $this->attributes['user_id'];
    }

    public function getCreatedAt(): Carbon
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->updated_at;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->attributes['user_id'] = $user->getId();
        $this->setRelation('user', $user);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function getPayment(): ?Payment
    {
        return $this->payment;
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function getItems(): Collection
    {
        return $this->items;
    }
}
