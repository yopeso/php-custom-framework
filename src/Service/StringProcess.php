<?php

namespace App\Service;

class StringProcess
{
    public function __construct(
        private SuffixService $suffix,
        private PrefixService $prefix
    ) {
    }

    public function processString(string $text): string
    {
        return $this->suffix->addSuffix($this->prefix->addPrefix($text));
    }
}
