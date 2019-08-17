<?php
declare(strict_types=1);

namespace Kata\Foxminded\TemplateMethod\internal;

abstract class AbstractFileWriter implements WriterInterface
{
    public function write(string $path): void
    {
        $handle = fopen($path, 'w');
        $this->writeData($handle);
        fclose($handle);
    }

    abstract protected function writeData($handle): void;
}
