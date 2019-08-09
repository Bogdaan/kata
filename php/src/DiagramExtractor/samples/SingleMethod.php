<?php
declare(strict_types=1);

namespace Kata\DiagramExtractor\samples;

class SingleMethod
{
    /**
     * context: public_site
     * actor: user
     *
     * api:
     * @see EmptyClass
     *
     * Get string with current unix time
     */
    public function getTime(): string
    {
        return sprintf("Unix time: %d", time());
    }
}
