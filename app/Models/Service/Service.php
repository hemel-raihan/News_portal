<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;

class Service extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function servicecategories()
    {
        return $this->belongsToMany(Servicecategory::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
