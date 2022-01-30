<?php

namespace App\Models\Pagebuilder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Custompage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pagebuilders()
    {
        return $this->hasMany(Pagebuilder::class)
              ->orderBy('order');
    }
}
