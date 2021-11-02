<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'status_id',
        'user_id',
        'name',
        'surname',
        'phone',
        'email',
        'country',
        'city',
        'address',
        'total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot(['quantity', 'single_price']);
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y, H:i');
    }


    public static function recalc($orders)
    {
        foreach ($orders as & $order) {
            $order->total = 0;
            $order->products->map(function ($product) use ($order) {
                $order->total += $product->pivot->quantity * $product->pivot->single_price;
            });
            $order->save();
        }
    }

    public function getCanBeCancelledAttribute(){
        return $this->status->name != config('constants.db.order_statuses.completed') &&
            $this->status->name != config('constants.db.order_statuses.cancelled');
    }
    public function payback()
    {
        $this->user->balance += $this->total;
        $this->user->save();
    }
}
