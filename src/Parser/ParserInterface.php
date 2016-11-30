<?php
namespace Bricks\Business\Currency\Parser;

use Bricks\Business\Currency\ConverterInterface;

/**
 * @author Artur Sh. Mamedbekov
 */
interface ParserInterface{
  /**
   * @param string $string Исходная строка с данными для парсинга.
   *
   * @return ConverterInterface Полученный конвертер валют.
   */
  public function parse($string);
}
