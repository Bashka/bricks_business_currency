<?php
namespace Bricks\Business\Currency;

use Bricks\Business\Currency\Exception\CannotGetRateException;

/**
 * @author Artur Sh. Mamedbekov
 */
interface ConverterInterface{
  /**
   * @param CurrencyInterface $currency Проверяемая валюта.
   *
   * @return bool true - если курс для данной валюты известен.
   */
  public function hasRate(CurrencyInterface $currency);

  /**
   * @param CurrencyInterface $currencyFrom Исходная валюта.
   * @param CurrencyInterface $currencyTo Целевая валюта.
   *
   * @throws CannotGetRateException Выбрасывается при невозможности определения 
   * курса валюты.
   *
   * @return float Стоимость единицы исходной валюты в целевой валюте.
   */
  public function getRate(CurrencyInterface $currencyFrom, CurrencyInterface $currencyTo);
}
