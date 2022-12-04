<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Attributes\Description;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class RacialIdentity extends Enum
{
    const White = 0;

    #[Description('Black or African American')]
    const Black = 1;

    #[Description('Hispanic or Latino')]
    const Hispanic = 3;

    #[Description('Native Hawaiian or Other Pacific Islander')]
    const Hawaiian = 4;

    #[Description('Asian')]
    const Asian = 5;
}
