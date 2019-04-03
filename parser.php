<?php

require './vendor/autoload.php';

use Mbyakow\HttpLogParser\Parser;

if (count($argv) === 1) {
    throw new \Error("Input file isn't specified.");
}

$file   = $argv[1];
$parser = new Parser();
$result = $parser->open($file)->parse();

echo $result->json(JSON_PRETTY_PRINT);
