<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attributevalue extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
