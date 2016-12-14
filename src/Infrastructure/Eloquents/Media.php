<?php

namespace Highday\Glitter\Infrastructure\Eloquents;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'filename',
        'path',
        'mime',
        'filesize',
    ];
}
