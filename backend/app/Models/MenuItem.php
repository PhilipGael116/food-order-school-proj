<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'discount_price',
        'image',
        'images',
        'is_available',
        'is_featured',
        'is_vegetarian',
        'is_vegan',
        'preparation_time',
        'calories',
        'allergens',
        'ingredients',
        'stock',
    ];

    protected $casts = [
        'images' => 'array',
        'allergens' => 'array',
        'ingredients' => 'array',
        'is_available' => 'boolean',
        'is_featured' => 'boolean',
        'is_vegetarian' => 'boolean',
        'is_vegan' => 'boolean',
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
    ];

    protected $appends = ['final_price', 'rating'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getFinalPriceAttribute()
    {
        return $this->discount_price ?? $this->price;
    }

    public function getRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
