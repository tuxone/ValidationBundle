<?php

namespace TuxOne\ValidationBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @Annotation
 */
class ContainsBadWordsValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $blacklist = file(__DIR__."/../../Dictionaries/list_en.txt", FILE_IGNORE_NEW_LINES);

        $message = strtolower($value);
        $message = preg_replace("/[^a-z0-9 ]/", ' ', $message);
        $message = explode(' ', $message);
        $message = array_unique($message);

        $match = array_intersect($message, $blacklist);

        if (count($match)>0) {
            $this->context->addViolation($constraint->message, array('%string%' => reset($match)));
        }
    }
}