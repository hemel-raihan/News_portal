<?php

namespace App\Models\Teams;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teamcategory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function parent()
    {
        return $this->belongsTo(Teamcategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Teamcategory::class, 'parent_id');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }

    public function teamposts()
    {
        return $this->belongsToMany(Teampost::class);
    }

    public static function findBySlug($slug)
    {
        return self::where('slug',$slug)->where('status',true)->firstOrFail();
    }
}
