# ChileanRut

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]

[comment]: <> ([![Build Status][ico-travis]][link-travis])

[comment]: <> ([![StyleCI][ico-styleci]][link-styleci])

A Chilean Rut script to handle ruts. Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer

``` bash
$ composer require innovaweb/chileanrut
```

## Usage

### Format Function
Format the rut according to the assigned parameters, if withDotted is true it will always return with a hyphen, return string value

| Params | Type | Description  |
| --- | --- | --- |
| $rut | string | rut with any of these formats 11.111.111-1, 11111111-1, 111111111 |
| $withDotted | bool | return rut with dots format, default true |
| $withHyphen | bool | return rut with hyphen format. default true |
```php
Rut::format('123123123'); // return 12.312.312-3
Rut::format('123123123', false); // return 12312312-3
Rut::format('123123123', false, false); // return 123123123 (it is best to use the unformat function)
```

### Unformat Function
Clean the rut of spaces, dots and hyphens, return string value

| Params | Type | Description  |
| --- | --- | --- |
| $rut | string | rut with any of these formats 11.111.111-1, 11111111-1, 111111111 |

```php
Rut::unformat('12.312.312-3'); // return 123123123
```

### Validate Function
Check if the code is valid with the validation algorithm, return boolean value

| Params | Type | Description  |
| --- | --- | --- |
| $rut | string | rut with any of these formats 11.111.111-1, 11111111-1, 111111111 |

```php
Rut::validate('12.312.312-3'); // return true
```

### Calculate Dv Function
Calculates the check digit from a sequential rut number, return string value

| Params | Type | Description  |
| --- | --- | --- |
| $number | int | only the number of rut as integer type |

```php
Rut::calculateDv(12312312); // return 3
```

### Get Number Function
Extract the numerical part of the rut, can return with points according to the parameters, return string value

| Params | Type | Description  |
| --- | --- | --- |
| $rut | string | rut with any of these formats 11.111.111-1, 11111111-1, 111111111 |
| $withDotted | bool | return rut with dots format, default true |

```php
Rut::getNumber('12312312-3'); // return 12312312
Rut::getNumber('12312312-3', true); // return 12.312.312
```


### Get Dv Function
Extract the check digit part of the rut, return string value

| Params | Type | Description  |
| --- | --- | --- |
| $rut | string | rut with any of these formats 11.111.111-1, 11111111-1, 111111111 |

```php
Rut::getDv('12312312-3'); // return 3
```




### Example
````php
namespace App\Http\Controllers;

use Innovaweb\ChileanRut\Rut;

class RutController extends Controller
{
    public function index()
    {
        $format = Rut::format('123123123');
        $unformat = Rut::unformat($format);
        return [
            $format,
            $unformat,
            Rut::validate($unformat),
            Rut::calculateDv(12312312),
            Rut::getNumber($format, false),
            Rut::getDv($format),
        ];
    }
}

````
Result 
```json
[
  "12.312.312-3",
  "123123123",
  true,
  "3",
  "12312312",
  "3"
]

```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

[comment]: <> (## Contributing)

[comment]: <> (Please see [contributing.md]&#40;contributing.md&#41; for details and a todolist.)

## Security

If you discover any security related issues, please email aisla@innovaweb.cl instead of using the issue tracker.

## Credits

- [Alejandro Isla][link-author]
- [All Contributors][link-contributors]

## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/innovaweb/chileanrut.svg?style=flat-square

[ico-downloads]: https://img.shields.io/packagist/dt/innovaweb/chileanrut.svg?style=flat-square

[ico-travis]: https://img.shields.io/travis/innovaweb/chileanrut/master.svg?style=flat-square

[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/innovaweb/chileanrut

[link-downloads]: https://packagist.org/packages/innovaweb/chileanrut

[link-travis]: https://travis-ci.org/innovaweb/chileanrut

[link-styleci]: https://styleci.io/repos/12345678

[link-author]: https://github.com/innovawebcl

[link-contributors]: ../../contributors
