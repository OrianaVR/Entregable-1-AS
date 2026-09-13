<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable
{
    /**
     * CLIENT ATTRIBUTES
     * $this->attributes['id'] - int - contains the client primary key (id)
     * $this->attributes['role'] - string - contains the client role (admin or client)
     * $this->attributes['name'] - string - contains the client name
     * $this->attributes['email'] - string - contains the client email
     * $this->attributes['password'] - string - contains the client password
     * $this->attributes['address'] - string - contains the client address
     * $this->attributes['phone'] - string - contains the client phone
     * $this->attributes['created_at'] - string - contains the date the client was created
     * $this->attributes['updated_at'] - string - contains the date the client was updated
     */
    use HasFactory, Notifiable;

    protected $table = 'clients';

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

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function getRole(): string
    {
        return $this->attributes['role'];
    }

    public function setRole(string $role): void
    {
        $this->attributes['role'] = $role;
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    public function getEmail(): string
    {
        return $this->attributes['email'];
    }

    public function setEmail(string $email): void
    {
        $this->attributes['email'] = $email;
    }

    public function getPassword(): string
    {
        return $this->attributes['password'];
    }

    public function setPassword(string $password): void
    {
        $this->attributes['password'] = $password;
    }

    public function getAddress(): string
    {
        return $this->attributes['address'];
    }

    public function setAddress(string $address): void
    {
        $this->attributes['address'] = $address;
    }

    public function getPhone(): string
    {
        return $this->attributes['phone'];
    }

    public function setPhone(string $phone): void
    {
        $this->attributes['phone'] = $phone;
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }
}
