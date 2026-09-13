<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
   /**
     * ORDER ATTRIBUTES
     * $this->attributes['id'] - int - contains the product primary key (id)
     * $this->attributes['address'] - string - contains the ubication of the client 
     * $this->attributes['state'] - string - contains the state of the order 
     * $this->attributes['delivery_date'] - string - contains the date the order will be delivered
     * $this->attributes['client_id'] - id - contains the client id related to the order
     * $this->client - Client - contains the associated client
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

    public function getClientId(): int
    {
    return $this->attributes['client_id'];
    }

    public function client():BelongsTo
    {
         return $this->belongsTo(Client::class);
    }

    public function getClient():Client
    {
      return $this->client;
    }

    public function setClient(Client $client):void
    {
     $this->client = $client;
    }
}

