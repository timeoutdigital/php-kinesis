# PHP Kinesis

Given a kinesis stream of data in the [avro file format](https://avro.apache.org/docs/1.2.0/spec.html#Object+Container+Files) this small, dodgy script will read from the stream and decode the data into JSON for you to enjoy.

## Running the project

 - If you don't have PHP installed `brew install php71`
 - Download [the latest .phar archive](https://github.com/timeoutdigital/php-kinesis/releases)
 - `php php-kinesis.phar region stream id TRIM_HORIZON` to see all stuff in your stream
 - `php php-kinesis.phar region stream id LATEST` to begin reading the stream from now


## Building from source

assuming composer is on your path


 - `composer install`
 - Edit index.php and set `TRACE_FILES` to 1 
 - Run the script against a stream with data for 5 minutes.
 - Verify that you now have a JSON file named files.json containing all the PHP files the script needed
 - Edit index.php and set `TRACE_FILES` back to 0 
 - Run `php build.php` to create the phar.
