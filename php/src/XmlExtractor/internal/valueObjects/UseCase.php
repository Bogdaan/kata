<?php
declare(strict_types=1);

namespace Kata\XmlExtractor\internal\valueObjects;

class UseCase
{
    /**
     * @var string
     */
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
