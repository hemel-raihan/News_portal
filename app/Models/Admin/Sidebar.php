<?php

namespace App\Models\Admin;
use App\Models\blog\category;
use App\Models\general_content\Contentcategory;
use App\Models\general_content\Contentpost;
use App\Models\Admin\Page;
use App\Models\blog\Post;
use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sidebar extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function blogCategories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function blogPosts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function contentCategories()
    {
        return $this->belongsToMany(Contentcategory::class);
    }

    public function contentPosts()
    {
        return $this->belongsToMany(Contentpost::class);
    }

    public function pages()
    {
        return $this->belongsToMany(Page::class);
    }

    public function widgets()
    {
        return $this->hasMany(Widget::class)->orderBy('order');
    }

}
