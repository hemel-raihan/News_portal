<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Sidebar;
use App\Models\Admin\Widget;

class Productcategory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function parent()
    {
        return $this->belongsTo(Productcategory::class, 'parent_id');
    }

    public function categories()
    {
        return $this->hasMany(Productcategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Productcategory::class, 'parent_id');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function sidebar()
    {
        return $this->belongsTo(Sidebar::class);
    }

    public function widgets()
    {
        return $this->hasMany(Widget::class);
    }

    public static function findBySlug($slug)
    {
        return self::where('slug',$slug)->where('status',true)->firstOrFail();
    }
}
