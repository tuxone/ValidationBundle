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
    private $useWildcard;

    public function __construct($dictionaryPath, $useWildcard)
    {
        $this->dictionaryPath = $dictionaryPath;
        $this->useWildcard    = $useWildcard;

    }

    public function validate($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return;
        }

        if ( ! is_scalar($value) && ! (is_object($value) && method_exists($value, '__toString'))) {
            throw new UnexpectedTypeException($value, 'string');
        }

        $stringValue = (string)$value;

        // Load blacklist
        $blacklist = $this->getBlackListArray();

        if ($this->useWildcard) {
            foreach ($blacklist as $word) {
                if (stripos($stringValue, $word) !== false) {
                    $this->context->buildViolation($constraint->message)
                                  ->setParameter('{{ word }}', $word)
                                  ->setCode(NotContainsBadWords::CONTAINS_BAD_WORD)
                                  ->addViolation();
                    break;
                }
            }
        } else {
            // Split input value into words
            $words = $this->getWordsArray($stringValue);

            // Search for bad words
            $match = array_intersect($words, $blacklist);

            if (count($match) > 0) {
                $this->context->buildViolation($constraint->message)
                              ->setParameter('{{ word }}', reset($match))
                              ->setCode(NotContainsBadWords::CONTAINS_BAD_WORD)
                              ->addViolation();
            }
        }
    }

    private function getBlackListArray()
    {
        return file($this->dictionaryPath, FILE_IGNORE_NEW_LINES);
    }

    private function getWordsArray($text)
    {
        $text  = strtolower($text);
        $text  = preg_replace("/[^a-z0-9 ]/", ' ', $text);
        $words = explode(' ', $text);
        $words = array_unique($words);

        return $words;
    }
}
