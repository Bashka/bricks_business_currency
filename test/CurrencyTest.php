<?php
namespace Bricks\Business\Currency\UnitTest;

use Bricks\Business\Currency\Currency;

/**
 * @author Artur Sh. Mamedbekov
 */
class CurrencyTest extends \PHPUnit_Framework_TestCase{
  public function testGetCharCode(){
    $charCode = 'USD';
    $currency = new Currency($charCode);

    $this->assertEquals($charCode, $currency->getCharCode());
  }
}
