# PHP String Tools

[![Latest Version on Packagist](https://img.shields.io/packagist/v/gaming-engine/timezone.svg?style=flat-square)](https://packagist.org/packages/gaming-engine/timezone)
[![Total Downloads](https://img.shields.io/packagist/dt/gaming-engine/timezone.svg?style=flat-square)](https://packagist.org/packages/gaming-engine/timezone)
![GitHub Actions](https://github.com/gaming-engine/string-tools/actions/workflows/main.yml/badge.svg)

A quick and easy wrapper for the timezone functions in PHP.

## Installation

You can install the package via composer:

```bash
composer require gaming-engine/timezone
```

## Usage

```php
use GamingEngine\Timezone\TimezoneList;

$timezones = TimezoneList::all();

// Provides all timezones
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email awjudd@gmail.com instead of using the issue tracker.

## Credits

- [Andrew Judd](https://github.com/gaming-engine)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
