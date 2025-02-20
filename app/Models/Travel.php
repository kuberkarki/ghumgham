<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Travel extends Model
{
    use HasFactory, Sluggable, HasUuids;
    protected $table="travels";

    protected $fillable=['name','is_public','slug','description','number_of_days'];

    public function tours(): HasMany
    {
        return $this->hasMany(Tour::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    // public function numberOfNights(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn($value, $attributes) => $attributes['number_of_days'] - 1,
    //     );
    // }
    // or alternate way
    public function getNumberOfNightsAttribute(){
        return $this->number_of_days - 1;
    }

    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }

}
