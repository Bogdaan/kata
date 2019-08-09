<?php
declare(strict_types=1);

namespace Kata\DiagramExtractor\samples;

class MultipleMethods extends SingleMethod
{
    /**
     * context: public_site
     * actor: user
     *
     * api:
     * @see EmptyClass
     *
     * Get random number
     */
    public function rand(): int
    {
        return mt_rand();
    }
}
