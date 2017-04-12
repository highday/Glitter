<?php

namespace Highday\Glitter\Eloquent\Models;

use Highday\Glitter\Contracts\Domain\Domainable;
use Highday\Glitter\Domain\Entities\Product as DomainEntity;
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

    public function getOptionsAttribute()
    {
        return array_filter([$this->option1, $this->option2, $this->option3]);
    }

    public function toDomain(): DomainEntity
    {
        $entity = new DomainEntity([
            'title'       => $this->title,
            'description' => $this->description,
            'options'     => $this->options,
            'variants'    => $this->variants->map->toDomain()->all(),
        ]);
        $entity->setId($this->getKey());

        return $entity;
    }
}
