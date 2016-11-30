<?php
namespace Bricks\Business\Currency\Parser;

use DOMDocument;
use Bricks\Business\Currency\Currency;
use Bricks\Business\Currency\Converter;

/**
 * @author Artur Sh. Mamedbekov
 */
class RussiaCentralBankXmlParser implements ParserInterface{
  /**
   * {@inheritdoc}
   */
  public function parse($string){
    $converter = new Converter(new Currency('RUR'));

    $dom = new DOMDocument('1.0', 'windows-1251');
    $dom->loadXML($string);
    foreach($dom->documentElement->getElementsByTagName('Valute') as $valuteNode){
      $currencyCharCode = $valuteNode->getElementsByTagName('CharCode')->item(0)->nodeValue;
      $currencyNominal = (int) $valuteNode->getElementsByTagName('Nominal')->item(0)->nodeValue;
      $currencyValue = (float) str_replace(',', '.', $valuteNode->getElementsByTagName('Value')->item(0)->nodeValue);
      $currencyValue /= $currencyNominal;
      $converter->addRate(new Currency($currencyCharCode), $currencyValue);
    }

    return $converter;
  }
}
