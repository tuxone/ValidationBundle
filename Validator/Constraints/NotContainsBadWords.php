<?php

namespace TuxOne\ValidationBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NotContainsBadWords extends Constraint
{
    const CONTAINS_BAD_WORD = '06f8750a-c8ff-49ec-89e9-4feee1b6cd25';

    public $message = 'The message contains an illegal word: {{ word }}.';

    public function validatedBy()
    {
        return 'tuxone_badword_validation';
    }
}