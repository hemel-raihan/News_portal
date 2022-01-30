<?php

namespace App\Models\Admin;
use App\Models\Admin;
use App\Models\Admin\Sidebar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
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
