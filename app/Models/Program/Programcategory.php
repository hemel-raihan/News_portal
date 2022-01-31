<?php

namespace App\Models\Program;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programcategory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function programs()
    {
        return $this->hasMany(Program::class);
    }
}
