<?php
namespace Bricks\Business\Currency;

/**
 * @author Artur Sh. Mamedbekov
 */
interface CurrencyInterface{
  /**
   * @return string Буквенный код валюты.
   */
  public function getCharCode();
}
