<?php

namespace Highday\Glitter\Eloquent\Models;

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
        'taxes_included',
        'inventory_management',
        'inventory_quantity',
        'out_of_stock_purchase',
        'requires_shipping',
        'weight',
        'weight_unit',
        'fulfillment_service',
    ];

    protected $cast = [
        'taxes_included'        => 'bool',
        'out_of_stock_purchase' => 'bool',
        'requires_shipping'     => 'bool',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function image()
    {
        return $this->belongsTo(Attachment::class, 'image_id');
    }

    public function getNameAttribute()
    {
        return join(', ', $this->options);
    }

    public function getOptionsAttribute()
    {
        return array_filter([$this->option1, $this->option2, $this->option3]);
    }

    public function setOptionsAttribute($value)
    {
        $options = array_filter(array_values($value));
        $this->attributes['option1'] = isset($options[0]) ? $options[0] : null;
        $this->attributes['option2'] = isset($options[1]) ? $options[1] : null;
        $this->attributes['option3'] = isset($options[2]) ? $options[2] : null;
    }
}
