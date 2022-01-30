<?php

namespace App\Models\blog;
use App\Models\Admin;
use App\Models\Admin\Sidebar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function categories()
    {
        return $this->belongsToMany(category::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function sidebars()
    {
        return $this->belongsToMany(Sidebar::class);
    }
}
