<?php
declare(strict_types=1);

namespace Kata\Foxminded\TemplateMethod\internal;

class CurrentDateWriter extends AbstractFileWriter
{
    protected function writeData($handle): void
    {
        fwrite($handle, date('Y-m-d'));
    }
}
