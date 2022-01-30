<?php

namespace App\Models\general_content;
use App\Models\Admin\Sidebar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;

class Contentpost extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function contentcategories()
    {
        return $this->belongsToMany(Contentcategory::class);
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
