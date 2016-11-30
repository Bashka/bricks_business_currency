<?php
namespace Bricks\Business\Currency\UnitTest\Parser;

use Bricks\Business\Currency\Parser\RussiaCentralBankXmlParser;
use Bricks\Business\Currency\Currency;

/**
 * @author Artur Sh. Mamedbekov
 */
class RussiaCentralBankXmlParserTest extends \PHPUnit_Framework_TestCase{
  public function testParse(){
    $string = '<ValCurs>' .
      '<Valute ID="R01235">' .
        '<NumCode>840</NumCode>' .
        '<CharCode>USD</CharCode>' .
        '<Nominal>1</Nominal>' .
        '<Name>Доллар США</Name>' .
        '<Value>0,5</Value>' .
      '</Valute>' .
    '</ValCurs>';
    $parser = new RussiaCentralBankXmlParser;

    $converter = $parser->parse($string);

    $this->assertEquals(0.5, $converter->getRate(new Currency('USD'), new Currency('RUR')));
  }

  public function testParse_shouldUseNominal(){
    $string = '<ValCurs>' .
      '<Valute ID="R01215">' .
        '<NumCode>208</NumCode>' .
        '<CharCode>DKK</CharCode>' .
        '<Nominal>10</Nominal>' .
        '<Name>Датских крон</Name>' .
        '<Value>20</Value>' .
      '</Valute>' .
    '</ValCurs>';
    $parser = new RussiaCentralBankXmlParser;

    $converter = $parser->parse($string);

    $this->assertEquals(2, $converter->getRate(new Currency('DKK'), new Currency('RUR')));
  }
}
