<?php

namespace App\Models\Address;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
