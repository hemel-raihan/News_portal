<?php

namespace App\Models\Pagebuilder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pagebuilder()
    {
        return $this->belongsTo(Pagebuilder::class);
    }
}
