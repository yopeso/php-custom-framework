<?php

namespace App\Service;

class PrefixService
{
    private $prefix;

    public function __construct(string $prefix)
    {
        $this->prefix = $prefix;
    }

    public function addPrefix(string $original): string
    {
        return sprintf('*%s* %s', $this->prefix, $original);
    }
}
