# PHP Kinesis

Given a kinesis stream of data in the [avro file format](https://avro.apache.org/docs/1.2.0/spec.html#Object+Container+Files) this small, dodgy script will read from the stream and decode the data into JSON for you to enjoy.

To build the .phar from source, assuming composer is on your path

```bash
composer install
```

Edit index.php and set `TRACE_FILES` to 1 before running it for 5 minutes.
This will result in `files.json` being written, a list of all classes the script needs.

When you're finished set `TRACE_FILES` back to 0 and run `php build.php` to create the phar.

then to run it

 - `php php-kinesis.phar region stream id TRIM_HORIZON` to see all stuff in your stream
 - `php php-kinesis.phar region stream id LATEST` to begin reading the stream from now
