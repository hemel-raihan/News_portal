<?php

namespace App\Models\Teams;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teampost extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function teamcategories()
    {
        return $this->belongsToMany(Teamcategory::class);
    }
}
