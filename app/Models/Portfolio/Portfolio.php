<?php

namespace App\Models\Portfolio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;

class Portfolio extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function portfoliocategories()
    {
        return $this->belongsToMany(Portfoliocategory::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
