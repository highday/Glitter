<?php

namespace Highday\Glitter\Domain\Entities;

use Highday\Glitter\Domain\Entity;

class Attachment extends Entity
{
    /** @var string */
    public $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
