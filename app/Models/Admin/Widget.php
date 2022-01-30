<?php

namespace App\Models\Admin;
use App\Models\blog\category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function Sidebar()
    {
        return $this->belongsTo(Sidebar::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
