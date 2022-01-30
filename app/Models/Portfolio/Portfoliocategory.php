<?php

namespace App\Models\Portfolio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfoliocategory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function parent()
    {
        return $this->belongsTo(Portfoliocategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Portfoliocategory::class, 'parent_id');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }

    public function portfolios()
    {
        return $this->belongsToMany(Portfolio::class);
    }
}
