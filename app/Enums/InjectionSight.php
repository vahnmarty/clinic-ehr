<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class InjectionSight extends Enum
{
    const LeftArm = 0;
    const RightArm = 1;
    const LeftThigh = 2;
    const RightThigh = 3;
    const Intranasal = 4;
}
