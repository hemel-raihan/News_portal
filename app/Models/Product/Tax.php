<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
