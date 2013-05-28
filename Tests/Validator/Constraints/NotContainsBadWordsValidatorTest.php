<?php

namespace TuxOne\ValidatorBundle\Tests\Validator\Constraints;

use TuxOne\ValidationBundle\Validator\Constraints\NotContainsBadWords;
use TuxOne\ValidationBundle\Validator\Constraints\NotContainsBadWordsValidator;

class ContainsBadWordsValidatorTest extends \PHPUnit_Framework_TestCase
{
    const VALID_INPUT = 'Hello world!';
    const NOT_VALID_INPUT = 'Hello pussy!';

    protected $context;
    protected $validator;

    protected function setUp()
    {
        $this->context = $this->getMock('Symfony\Component\Validator\ExecutionContext', array(), array(), '', false);
        $this->validator = new NotContainsBadWordsValidator();
        $this->validator->initialize($this->context);
    }

    protected function tearDown()
    {
        $this->context = null;
        $this->validator = null;
    }

    public function testNullIsValid()
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $this->validator->validate(null, new NotContainsBadWords());
    }

    public function testEmptyStringIsValid()
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $this->validator->validate('', new NotContainsBadWords());
    }

    public function testSampleStringIsValid()
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $this->validator->validate(self::VALID_INPUT, new NotContainsBadWords());
    }

    public function testBadStringIsNotValid()
    {
        $this->context->expects($this->once())
            ->method('addViolation');

        $this->validator->validate(self::NOT_VALID_INPUT, new NotContainsBadWords());
    }

    /**
     * @expectedException Symfony\Component\Validator\Exception\UnexpectedTypeException
     */
    public function testExpectsStringCompatibleType()
    {
        $this->validator->validate(new \stdClass(), new NotContainsBadWords());
    }
}