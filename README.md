parse_time
===========

This package adds a single function called `parse_time` to your project. It does one thing. Parses times.

This function can parse times that are in a range like `11-5` or `11 AM to 5 PM`.

## Installation

Put a file named composer.json at the root of your project, containing your project dependencies:

```json
{
    "require": {
        "invokemedia/parsetime": ">=1.0"
    }
}
```

Or use `composer require invokemedia/parsetime`

## Usage

```
parse_time('11 AM - 5 PM');
parse_time('11:22 - 5:31');
parse_time('I will arrive at 1:22 and leave at 9:45');
```

The function basically wraps up the [date_parse](http://php.net/manual/en/function.date-parse.php) function. It will be run over the match for `11 AM` and `5 PM`.

Check out the test file for some of the examples.

## Running tests

Go to the project root and run `phpunit`.

## License

**The MIT License**

Copyright (c) 2016 [Invoke Media](http://invokemedia.com) webmaster@invokemedia.com

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
'Software'), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.