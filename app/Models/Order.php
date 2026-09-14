<?php

// AUTHOR: Maria Laura Tafur Gomez

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function setUser(User $user): void
    {
        $this->user = $user;
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

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

    public function getUserId(): int
    {
        return $this->attributes['user_id'];
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
