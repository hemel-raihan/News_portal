<?php

namespace App\Models\Frontmenu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frontmenu extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function menuItems()
    {
        return $this->hasMany(Frontmenuitem::class)
              ->doesntHave('parent')
              ->orderBy('order');
    }
}
