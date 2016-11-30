# Валюта

Интерфейс _CurrencyInterface_ определяет общую семантику денежной единицы через метод _getCharCode_, который должен возвращать буквенный код данной валюты.

Класс _Currency_ является стандартной реализацией этого интерфейса используя паттерн "Объект-значение".

```php
$currency = new Currency('USD');
```

# Курсы валютных пар

Интерфейс _ConverterInterface_ описывает механизм получения курса валютной пары с помощью метода _getRate_. Данный метод возвращает стоимость одной единицы исходной валюты (первый аргумент) в единицах целевой валюты (второй аргумент).

Класс _Converter_ является стандартной реализацией этого интерфейса и использует понятие "Базовой валюты", а так же значения курсов других валют по отношению к базовой для расчета курсов:

```php
$baseCurrency = new Currency('RUR'); // Базовая валюта
$converter = new Converter($baseCurrency);

$usd = new Currency('USD');
$converter->addRate($usd, 2); // Курс валютной пары RUR/USD определен как 1 USD за 2 RUR
$gbp = new Currency('GBP');
$converter->addRate($gbp, 4); // Курс валютной пары RUR/GBP определен как 1 GBP за 4 RUR

echo $converter->getRate($usd, $gbp); // 0.5 - стоимость 1 единицы USD в валюте GBP
```

Важно помнить, что курс базовой валюты к самой себе всегда равен единице и это нельзя изменить.

# Парсеры

Интерфейс _ParserInterface_ определяет семантику механизмов парсинга "сырых данных" о курсах валютных пар в объект класса _Converter_. Для этих целей используется метод _parse_, принимающий строку исходных данных и возвращающий сформированный экземпляр класса _Converter_.

## RussiaCentralBankXmlParser

Класс _RussiaCentralBankXmlParser_ является реализацией интерфейса _ParserInterface_, использующего данные, предоставляемые сайтом ["Центрального банка России"](http://www.cbr.ru/scripts/XML_daily.asp).

```php
$parser = new RussiaCentralBankXmlParser;
$converter = $parse->parse(file_get_contents('http://www.cbr.ru/scripts/XML_daily.asp'));
...
```
