<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
   /**
     * ORDER ATTRIBUTES
     * $this->attributes['id'] - int - contains the product primary key (id)
     * $this->attributes['address'] - string - contains the ubication of the user 
     * $this->attributes['state'] - string - contains the state of the order 
     * $this->attributes['delivery_date'] - string - contains the date the order will be delivered
     * $this->attributes['user'] - id - contains the user id related to the order
     * $this->user - User - contains the associated user
     * 
     * 
     */
    protected $fillable = ['address','state', 'delivery_date'];
    

   
    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function getAddress(): string
    {
        return $this->attributes['address'];
    }

    public function setAddress(string $address): void
    {
        $this->attributes['address'] = $address;
    }

     public function getState(): string
    {
        return $this->attributes['state'];
    }

    public function setState(string $state): void
    {
        $this->attributes['state'] = $state;
    }

      public function getDeliveryDate(): string
    {
       return $this->attributes['delivery_date'];

    }  
    public function setDeliveryDate(string $deliveryDate): void
    {
        $this->attributes['delivery_date'] = $deliveryDate;
    }

   public function getUserId(): int
    {
        return $this->attributes['user_id'];
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
        $this->user = $user;
    }
}

