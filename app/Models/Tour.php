<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tour extends Model
{
    use HasFactory, HasUuids;
    protected $fillable=['name','starting_date','ending_date','price'];

    // public function getPriceAttribute(){
    //     return $this->price/100;
    // }
    // public function setPriceAttribute(){
    //     return $this->price*100;
    // }

    public function price():Attribute{
        return Attribute::make(
            get: fn($value) => $this->price/100,
            set: fn($value) => $this->price*100

        );
    }
}
