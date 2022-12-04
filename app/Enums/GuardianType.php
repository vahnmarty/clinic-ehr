<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class GuardianType extends Enum
{
    const Father = 0;
    const Mother = 1;
    const Guardian = 2;
    const Grandparent = 3;
}
