<?php

namespace Glitter\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'store_id',
        'name',
        'description',
        'option1',
        'option2',
        'option3',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function media()
    {
        return $this->belongsToMany(Attachment::class, 'product_media');
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function getPriceRangeAttribute()
    {
        $prices = $this->variants->map(function ($variant) {
            return $variant->price;
        })->unique();

        return array_unique([$prices->min(), $prices->max()]);
    }

    public function getReferencePriceRangeAttribute()
    {
        $prices = $this->variants->map(function ($variant) {
            return $variant->reference_price;
        })->toBase()->filter()->unique();

        return array_unique([$prices->min(), $prices->max()]);
    }

    public function getOptionsAttribute()
    {
        return array_filter([$this->option1, $this->option2, $this->option3]);
    }
}
