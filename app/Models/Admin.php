<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\blog\Post;
use App\Models\Product\Product;
use App\Models\Service\Service;
use App\Models\Portfolio\Portfolio;
use App\Models\Pricing_Table\Price;
use App\Models\Admin\Page;
use App\Models\general_content\Contentpost;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasPermission($permission) : bool
    {
        return $this->role->permissions()->where('slug', $permission)->first() ? true : false;
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    public function contentposts()
    {
        return $this->hasMany(Contentpost::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }
}
