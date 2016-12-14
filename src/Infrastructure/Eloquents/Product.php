<?php

namespace Highday\Glitter\Infrastructure\Eloquents;

use Highday\Glitter\Contracts\Domain\Domainable;
use Highday\Glitter\Domain\Entities\Product as ProductEntity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model implements Domainable
{
    use SoftDeletes;

    protected $fillable = [
        'store_id',
        'title',
        'description',
        'option1',
        'option2',
        'option3',
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function media()
    {
        return $this->belongsToMany(Media::class, 'product_media');
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function toDomain(): ProductEntity
    {
        $entity = new ProductEntity($this->title, $this->description);
        $entity->setId($this->getKey());

        return $entity;
    }
}
