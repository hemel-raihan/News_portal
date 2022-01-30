<?php

namespace App\Models\Pricing_Table;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricecategory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function parent()
    {
        return $this->belongsTo(Pricecategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Pricecategory::class, 'parent_id');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }

    public function prices()
    {
        return $this->belongsToMany(Price::class);
    }
}
