<?php

namespace Highday\Glitter\Eloquents\Models;

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
