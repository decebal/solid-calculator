# Calculator
Small Calculator Sample

## Install

Via Git

``` bash
$ git clone https://github.com/solid-decebal/calculator.git
$ composer install
```

## Usage

``` php
$calculator = new App\Controller\Calculator();
echo $calculator->compute('3+6*2-1');
```

## Testing

``` bash
$ phpunit
$ phpspec
```

## Credits

- [decebal](https://github.com/decebal)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more
information.
