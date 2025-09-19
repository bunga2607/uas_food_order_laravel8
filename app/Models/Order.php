<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
       'user_id', 'order_date', 'total_price', 'status',
    'address', 'phone', 'note', 'payment_method'
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function rating()
{
    return $this->hasOne(Rating::class);
}

}
