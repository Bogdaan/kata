<?php
declare(strict_types=1);

namespace Kata\Foxminded\TemplateMethod;

use Kata\Foxminded\TemplateMethod\internal\CurrentDateWriter;
use Kata\Foxminded\TemplateMethod\internal\CurrentTimeWriter;

class Client
{
    public function main()
    {
        $writer = new CurrentDateWriter();
        $writer->write('/tmp/one.txt');

        $writer = new CurrentTimeWriter();
        $writer->write('/tmp/two.txt');
    }
}
