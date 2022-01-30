<?php

namespace App\Models\Admin\Slide;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function slides(){
        return $this->hasMany(Slide::class);
    }
}
