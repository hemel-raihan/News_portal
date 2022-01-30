<?php

namespace App\Models\Pagebuilder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagebuilder extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function custompage()
    {
        return $this->belongsTo(Custompage::class);
    }

    public function elements()
    {
        return $this->hasMany(Element::class);
    }

    public function childs()
    {
        return $this->hasMany(Pagebuilder::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Pagebuilder::class, 'parent_id', 'id');
    }
}
