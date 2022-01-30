<?php

namespace App\Models\general_content;
use App\Models\Admin\Sidebar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contentcategory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function parent()
    {
        return $this->belongsTo(Contentcategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Contentcategory::class, 'parent_id');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }

    public function contentposts()
    {
        return $this->belongsToMany(Contentpost::class);
    }

    public function sidebars()
    {
        return $this->belongsToMany(Sidebar::class);
    }

    public static function findBySlug($slug)
    {
        return self::where('slug',$slug)->where('status',true)->firstOrFail();
    }
}
