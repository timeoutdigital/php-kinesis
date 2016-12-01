<?php

//http://docs.aws.amazon.com/aws-sdk-php/v3/api/

define("TRACE_FILES", 0);
require("vendor/autoload.php");
use Aws\Kinesis\KinesisClient;

if (count($argv) < 3) {
  die("Usage: php-kinesis <aws region> <stream id> [event=LATEST]\n");
}

$event = $argv[3] ?? 'LATEST';
list($region, $stream) = array_slice($argv, 1);

$client = KinesisClient::factory([
    'profile' => 'default',
    'region'  => $region,
    'version' => '2013-12-02'
]);

$shardId = $client->describeStream([
  'StreamName' => $stream
])['StreamDescription']['Shards'][0]['ShardId'];

$shardIterator = $client->getShardIterator([
  'StreamName' => $stream,
  'ShardId' => $shardId,
  'ShardIteratorType' => $event
])['ShardIterator'];

while(true) {

  try {
    $result = $client->getRecords(['ShardIterator' => $shardIterator]);
  } catch (Exception $e) {
    sleep(1);
    continue;
  }

  if ($result['NextShardIterator']) {
    $shardIterator = $result['NextShardIterator'];
  }

  $avro = array_map(function($r) {
    $io = new AvroStringIO($r['Data']);
    $reader = new AvroDataIOReader($io, new AvroIODatumReader());
    return $reader->data()[0];
  }, $result['Records']);

  foreach($avro as $a) {
      echo json_encode($a);
  }

  if (TRACE_FILES) {
    file_put_contents("files.json", json_encode(get_included_files()));
  }
}
