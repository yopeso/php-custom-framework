<?php

namespace App\Service;

use DI\Annotation\Inject;

class SuffixService
{
    /** @Inject("suffix") */
    private $suffix;

    public function addSuffix(string $original): string
    {
        return sprintf(' %s *%s*', $original, $this->suffix);
    }
}
