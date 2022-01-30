<?php

namespace App\Models\blog;
use App\Models\Admin\Sidebar;
use App\Models\Admin\Widget;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
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
