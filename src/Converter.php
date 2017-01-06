<?php
namespace Bricks\Business\Currency;

use ArrayObject;
use Bricks\Business\Currency\Exception\ChangeValueBaseCurrencyException;
use Bricks\Business\Currency\Exception\CannotGetRateException;

/**
 * @author Artur Sh. Mamedbekov
 */
class Converter implements ConverterInterface{
  /**
   * @var CurrencyInterface Базовая валюта, курс которой используется в качестве 
   * основания для конверсии.
   */
  private $baseCurrency;

  /**
   * @var int[] Словарь курсов валют по отношению к базовой валюте.
   */
  private $rates;

  /**
   * @param CurrencyInterface $baseCurrency Базовая валюта.
   */
  public function __construct(CurrencyInterface $baseCurrency){
    $this->baseCurrency = $baseCurrency;
    $this->rates = new ArrayObject([
      $this->baseCurrency->getCharCode() => 1.0,
    ]);
  }

  /**
   * @return CurrencyInterface Базовая валюта.
   */
  public function getBaseCurrency(){
    return $this->baseCurrency;
  }

  /**
   * @param CurrencyInterface $targetCurrency Целевая валюта.
   * @param float $value Стоимость целевой валюты в единицах базовой валюты.
   *
   * @throws ModificationValueBaseCurrencyException Выбрасывается при попытки 
   * указания стоимости базовой валюты.
   */
  public function addRate(CurrencyInterface $targetCurrency, $value){
    if($targetCurrency->getCharCode() == $this->baseCurrency->getCharCode()){
      throw new ChangeValueBaseCurrencyException(sprintf('Cannot change value of the base currency "%s".', $this->baseCurrency->getCharCode()));
    }
    $this->rates[$targetCurrency->getCharCode()] = (float) $value;
  }

  /**
   * {@inheritdoc}
   */
  public function hasRate(CurrencyInterface $currency){
    return isset($this->rates[$currency->getCharCode()]);
  }

  /**
   * {@inheritdoc}
   */
  public function getRate(CurrencyInterface $currencyFrom, CurrencyInterface $currencyTo){
    if(!isset($this->rates[$currencyFrom->getCharCode()])){
      throw new CannotGetRateException(sprintf('Rate for "%s" not found.', $currencyFrom->getCharCode()));
    }
    if(!isset($this->rates[$currencyTo->getCharCode()])){
      throw new CannotGetRateException(sprintf('Rate for "%s" not found.', $currencyTo->getCharCode()));
    }

    return $this->rates[$currencyFrom->getCharCode()] / $this->rates[$currencyTo->getCharCode()];
  }
}
