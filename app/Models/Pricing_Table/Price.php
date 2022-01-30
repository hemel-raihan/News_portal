<?php

namespace App\Models\Pricing_Table;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;

class Price extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pricecategories()
    {
        return $this->belongsToMany(Pricecategory::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
