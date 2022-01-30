<?php

namespace App\Models\Frontmenu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frontmenuitem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function menu()
    {
        return $this->belongsTo(Frontmenu::class);
    }

    public function childs()
    {
        return $this->hasMany(Frontmenuitem::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Frontmenuitem::class, 'parent_id', 'id');
    }
}
