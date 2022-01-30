<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CombinedOrder extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function orders(){
    	return $this->hasMany(Order::class);
    }
}
