<?php

/**
 * @author Ana Sofía Angarita Barrios
 *
 * @property int $id
 * @property string $method
 * @property \Illuminate\Support\Carbon $date
 * @property string $status
 * @property int $transaction_code
 * @property int $order_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    public $timestamps = true;

    protected $fillable = ['method', 'date', 'status', 'transaction_code', 'order_id'];

    protected $guarded = ['id'];

    public function setMethod(string $method): void
    {
        $this->attributes['method'] = $method;
    }

    public function setDate(string $date): void
    {
        $this->attributes['date'] = $date;
    }

    public function setStatus(string $status): void
    {
        $this->attributes['status'] = $status;
    }

    public function setTransactionCode(int $transactionCode): void
    {
        $this->attributes['transaction_code'] = $transactionCode;
    }

    public function setOrderId(int $orderId): void
    {
        $this->attributes['order_id'] = $orderId;
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getMethod(): string
    {
        return $this->attributes['method'];
    }

    public function getDate(): string
    {
        return $this->attributes['date'];
    }

    public function getStatus(): string
    {
        return $this->attributes['status'];
    }

    public function getTransactionCode(): int
    {
        return $this->attributes['transaction_code'];
    }

    public function getOrderId(): int
    {
        return $this->attributes['order_id'];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
