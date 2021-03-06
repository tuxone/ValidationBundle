<?php

namespace TuxOne\ValidationBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * @Annotation
 */
class NotContainsBadWordsValidator extends ConstraintValidator
{
    private $dictionaryPath;

    public function __construct($dictionaryPath)
    {
        $this->dictionaryPath = $dictionaryPath;
        
    }

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
        $blacklist = $this->getBlackListArray();

        // Split input value into words
        $words = $this->getWordsArray($stringValue);

        // Search for bad words
        $match = array_intersect($words, $blacklist);

        if ( count($match) > 0 ) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ word }}', reset($match))
                ->setCode(NotContainsBadWords::CONTAINS_BAD_WORD)
                ->addViolation();
        }
    }

    private function getBlackListArray()
    {
        return file($this->dictionaryPath, FILE_IGNORE_NEW_LINES);
    }

    private function getWordsArray($text)
    {
        $text = strtolower($text);
        $text = preg_replace("/[^a-z0-9 ]/", ' ', $text);
        $words = explode(' ', $text);
        $words = array_unique($words);
        return $words;
    }
}
