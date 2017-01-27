<?php

namespace Highday\Glitter\Eloquents\Models;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'option1',
        'option2',
        'option3',
        'sku',
        'barcode',
        'price',
        'reference_price',
        'inventory_management',
        'inventory_quantity',
        'inventory_policy',
        'requires_shipping',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function image()
    {
        return $this->belongsTo(Attachment::class, 'image_id');
    }
}
