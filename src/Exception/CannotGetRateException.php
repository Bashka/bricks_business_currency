<?php
namespace Bricks\Business\Currency\Exception;

use RuntimeException;

/**
 * Выбрасывается при невозможности определения курса валюты.
 *
 * @author Artur Sh. Mamedbekov
 */
class CannotGetRateException extends RuntimeException{
}
