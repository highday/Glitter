<?php

namespace Glitter\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'filename',
        'path',
        'mime',
        'filesize',
    ];
}
