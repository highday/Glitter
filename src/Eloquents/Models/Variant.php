<?php

namespace Highday\Glitter\Eloquents\Models;

use Highday\Glitter\Contracts\Domain\Domainable;
use Highday\Glitter\Domain\Entities\Variant as DomainEntity;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model implements Domainable
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

    public function getOptionsAttribute()
    {
        return array_filter([ $this->option1, $this->option2, $this->option3 ]);
    }

    public function toDomain(): DomainEntity
    {
        $options = [];
        foreach ($this->product->options as $i => $name) {
            $options[] = [$name, isset($this->options[$i]) ? $this->options[$i] : ''];
        }

        $entity = new DomainEntity(
            $this->sku ?: '',
            $options,
            $this->price,
            $this->reference_price
        );
        $entity->setId($this->getKey());

        return $entity;
    }
}
