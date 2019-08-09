<?php
declare(strict_types=1);

namespace Kata\DiagramExtractor\internal\valueObjects;

class UseCase
{
    public const COMMAND = 'command';
    public const QUERY = 'query';
    public const REQUEST = 'request';

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $cqrs;

    public function __construct(string $name, string $cqrs)
    {
        $this->name = $name;
        $this->cqrs = $cqrs;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCqrs(): string
    {
        return $this->cqrs;
    }
}
