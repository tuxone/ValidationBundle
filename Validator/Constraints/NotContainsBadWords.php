<?php

namespace TuxOne\ValidationBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NotContainsBadWords extends Constraint
{
    public $message = "The message contains an illegal word: '%string%'";
}