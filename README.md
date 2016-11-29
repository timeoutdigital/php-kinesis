# PHP Kinesis

Given a kinesis stream of data in the [avro file format](https://avro.apache.org/docs/1.2.0/spec.html#Object+Container+Files) this small, dodgy script will read from the stream and decode the data into JSON for you to enjoy.

To build the .phar from source, assuming composer is on your path

```bash
composer install
vendor/bin/phar-composer build .
chmod +x php-kinesis.phar
```

then to run it

 - `./php-kinesis.phar region stream id TRIM_HORIZON` to see all stuff in your stream
 - `./php-kinesis.phar region stream id LATEST` to begin reading the stream from now

