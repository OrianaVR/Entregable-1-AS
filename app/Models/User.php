<?php

/**
 * @author Ana Sofía Angarita Barrios
 *
 * @property int $id
 * @property string $role
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $address
 * @property string $phone
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Order> $orders
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = true;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'address',
        'phone',
    ];

    protected $guarded = [
        'id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function setRole(string $role): void
    {
        $this->attributes['role'] = $role;
    }

    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    public function setEmail(string $email): void
    {
        $this->attributes['email'] = $email;
    }

    public function setPassword(string $password): void
    {
        $this->attributes['password'] = $password;
    }

    public function setAddress(string $address): void
    {
        $this->attributes['address'] = $address;
    }

    public function setPhone(string $phone): void
    {
        $this->attributes['phone'] = $phone;
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getRole(): string
    {
        return $this->attributes['role'];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function getEmail(): string
    {
        return $this->attributes['email'];
    }

    public function getPassword(): string
    {
        return $this->attributes['password'];
    }

    public function getAddress(): string
    {
        return $this->attributes['address'];
    }

    public function getPhone(): string
    {
        return $this->attributes['phone'];
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function getOrders(): Collection
    {
        return $this->orders;
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
