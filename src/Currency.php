<?php
namespace Bricks\Business\Currency;

/**
 * @author Artur Sh. Mamedbekov
 */
final class Currency implements CurrencyInterface{
  /**
   * @var string Буквенный код валюты.
   */
  private $charCode;

  /**
   * @param string $charCode Буквенный код валюты.
   */
  public function __construct($charCode){
    $this->charCode = $charCode;
  }

  /**
   * {@inheritdoc}
   */
  public function getCharCode(){
    return $this->charCode;
  }
}
