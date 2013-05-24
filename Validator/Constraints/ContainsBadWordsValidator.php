<?php

namespace TuxOne\ValidationBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * @Annotation
 */
class ContainsBadWordsValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return;
        }

        if (!is_scalar($value) && !(is_object($value) && method_exists($value, '__toString'))) {
            throw new UnexpectedTypeException($value, 'string');
        }

        $stringValue = (string) $value;

        // Load blacklist
        $blacklist = file(__DIR__."/../../Dictionaries/list_en.txt", FILE_IGNORE_NEW_LINES);

        // split value
        $words = $this->getWords($stringValue);

        // search for bad words in value
        $match = array_intersect($words, $blacklist);

        if (count($match)>0) {
            $this->context->addViolation($constraint->message, array('%string%' => reset($match)));
        }
    }

    private function getWords($text)
    {
        $text = strtolower($text);
        $text = preg_replace("/[^a-z0-9 ]/", ' ', $text);
        $words = explode(' ', $text);
        $words = array_unique($words);
        return $words;
    }
}