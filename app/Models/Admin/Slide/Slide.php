<?php

namespace App\Models\Admin\Slide;

use App\Models\Admin\Slide\Slider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slide extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function slider(){
        return $this->belongsTo(Slider::class);
    }
}
