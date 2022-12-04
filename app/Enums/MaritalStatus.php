<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class MaritalStatus extends Enum
{
    const Single = 0;
    const Married = 1;
    const Divorced = 2;
    const Separated = 3;
    const Widowed = 4;
}
