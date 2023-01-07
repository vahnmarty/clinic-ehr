<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class FormType extends Enum
{
    const IntermittentHealthForm = 0;
    const MaternalHealthQuestionairre = 1;
    const ParentalHistoryQuestionairre = 2;
    const AgriculturalQuestionnaire = 3;
}
