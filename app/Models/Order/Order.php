<?php

namespace App\Models\Order;

use App\Models\User;
use App\Models\Order\OrderDetail;
use App\Models\Order\CombinedOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function combinedOrders(){
        return $this->belongsTo(CombinedOrder::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
