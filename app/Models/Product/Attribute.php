<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function attributevalues()
    {
        return $this->hasMany(Attributevalue::class);
    }
}
