<?php
declare(strict_types=1);

namespace Kata\XmlExtractor\internal\valueObjects;

class Group
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var UseCase[]
     */
    private $cases;

    public function __construct(string $name, array $cases)
    {
        $this->name = $name;
        $this->cases = $cases;
    }

    public function add(UseCase $node): void
    {
        $this->cases[] = $node;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUseCases(): array
    {
        return $this->cases;
    }
}
