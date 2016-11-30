<?php
namespace Bricks\Business\Currency\Exception;

use RuntimeException;

/**
 * Выбрасывается при попытке изменения курса базовой валюты.
 *
 * @author Artur Sh. Mamedbekov
 */
class ChangeValueBaseCurrencyException extends RuntimeException{
}
