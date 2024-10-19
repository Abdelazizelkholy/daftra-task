<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity'
    ];

    public function orders(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_product')
            ->withPivot('quantity')
            ->withTimestamps();
    }


    public function scopeSearch(Builder $query, $searchTerm = null, $minPrice = null, $maxPrice = null)
    {
        if ($searchTerm) {
            $query->where('name', 'LIKE', '%' . $searchTerm . '%');
        }

        if (!is_null($minPrice) && !is_null($maxPrice)) {
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        } elseif (!is_null($minPrice)) {
            $query->where('price', '>=', $minPrice);
        } elseif (!is_null($maxPrice)) {
            $query->where('price', '<=', $maxPrice);
        }

        return $query;
    }



}
