<?php
namespace Bricks\Business\Currency\UnitTest;

use Bricks\Business\Currency\Currency;
use Bricks\Business\Currency\Converter;
use Bricks\Business\Currency\Exception\ChangeValueBaseCurrencyException;
use Bricks\Business\Currency\Exception\CannotGetRateException;

/**
 * @author Artur Sh. Mamedbekov
 */
class ConverterTest extends \PHPUnit_Framework_TestCase{
  public function testConstructor_shouldSetRateForBaseCurrency(){
    $baseCurrency = new Currency('USD');
    $converter = new Converter($baseCurrency);

    $this->assertEquals(1, $converter->getRate($baseCurrency, $baseCurrency));
  }

  public function testGetBaseCurrency(){
    $baseCurrency = new Currency('USD');
    $converter = new Converter($baseCurrency);

    $this->assertEquals($baseCurrency, $converter->getBaseCurrency());
  }

  public function testAddRate(){
    $baseCurrency = new Currency('USD');
    $converter = new Converter($baseCurrency);

    $currency = new Currency('RUR');
    $value = 0.5;
    $converter->addRate($currency, $value);

    $this->assertEquals($value, $converter->getRate($currency, $baseCurrency));
  }

  public function testAddRate_shouldThrowExceptionIfChangeBaseCurrencyValue(){
    $baseCurrency = new Currency('USD');
    $converter = new Converter($baseCurrency);

    $this->setExpectedException(ChangeValueBaseCurrencyException::class);
    $converter->addRate($baseCurrency, 2);
  }

  public function testHasRate(){
    $baseCurrency = new Currency('USD');
    $converter = new Converter($baseCurrency);

    $this->assertTrue($converter->hasRate($baseCurrency));
    $this->assertFalse($converter->hasRate(new Currency('RUR')));
  }

  public function testGetRate(){
    $baseCurrency = new Currency('USD');
    $converter = new Converter($baseCurrency);
    
    $currency = new Currency('RUR');
    $converter->addRate($currency, 0.5);
    
    $this->assertEquals(2, $converter->getRate($baseCurrency, $currency));
  }

  public function testGetRate_shouldThrowExceptionIfRateNotSet(){
    $baseCurrency = new Currency('USD');
    $converter = new Converter($baseCurrency);

    $this->setExpectedException(CannotGetRateException::class);
    $converter->getRate($baseCurrency, new Currency('RUR'));
  }
}
