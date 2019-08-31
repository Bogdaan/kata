<?php
declare(strict_types=1);

function getFileName(int $version)
{
    return sprintf(__DIR__  . '/resource.%s.txt', $version);
}

$args = $argv[1];
echo "- start " . $args . PHP_EOL;

$handle = fopen(getFileName(1), 'w');
sleep((int)$argv[2]);

echo "+ write " . $args . PHP_EOL;
fputs($handle, print_r($args, true));
fclose($handle);

echo "> rename " . $args . PHP_EOL;
rename(getFileName(1), getFileName(2));

