<?php

/*
 * Run php-kineis with TRACE_FILES set to on to produce files.json
 * which is a list of all the autoloaded files it actually needs, then run this
 */

$phar = new Phar('php-kinesis.phar', 0, 'php-kinesis.phar');
$files = new ArrayIterator(json_decode(file_get_contents("files.json")));

$phar->buildFromIterator($files,'.');
$phar->setStub($phar->createDefaultStub('index.php', 'index.php'));
