<?php

namespace Highday\Glitter\Infrastructure\Eloquents;

use Highday\Glitter\Contracts\Domain\Domainable;
use Highday\Glitter\Domain\Entities\Product as ProductEntity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model implements Domainable
{
    use SoftDeletes;

    protected $appends = [
        'taxonomies',
        'types',
        'options',
    ];

    protected $fillable = [
        'name',
        'description',
    ];

    protected $dates = ['deleted_at'];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function toDomain(): ProductEntity
    {
        $entity = new ProductEntity($this->name, $this->description);
        $entity->setId($this->getKey());

        return $entity;
    }
}
