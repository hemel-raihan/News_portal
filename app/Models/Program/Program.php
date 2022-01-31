<?php

namespace App\Models\Program;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function programcategory()
    {
        return $this->belongsTo(Programcategory::class);
    }
}
