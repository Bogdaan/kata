<?php
declare(strict_types=1);

namespace Kata\Foxminded\TemplateMethod\internal;

class CurrentTimeWriter extends AbstractFileWriter
{
    protected function writeData($handle): void
    {
        fwrite($handle, date('H:i:s'));
    }
}
