<?php

namespace Glitter\Eloquent\Models;

use Glitter\Eloquent\Relations\CircleCustomer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * Class Circle
 *
 * @package Glitter\Eloquent\Models
 *
 * @property int    store_id
 * @property string name
 * @property string description
 */
class Circle extends Model
{
    use Notifiable, SoftDeletes;

    protected $fillable = [
        'store_id',
        'name',
        'description',
    ];

    protected $dates = [
        'deleted_at',
    ];

    /**
     * @return BelongsTo|Builder
     */
    public function store()
    {
        return $this->belongsTo(Store::class, 'id', 'store_id');
    }

    /**
     * @return BelongsToMany|Builder
     */
    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'circle_customer')
                    ->using(CircleCustomer::class);
    }
}
