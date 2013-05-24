<?php

namespace TuxOne\ValidatorBundle\Tests\Validator\Constraints;

use TuxOne\ValidationBundle\Validator\Constraints\ContainsBadWords;
use TuxOne\ValidationBundle\Validator\Constraints\ContainsBadWordsValidator;

// This assumes that this class file is located at:
// src/Application/AcmeBundle/Tests/ContainerAwareUnitTestCase.php
// with Symfony 2.0 Standard Edition layout. You may need to change it
// to fit your own file system mapping.

class ContainsBadWordsValidatorTest extends \PHPUnit_Framework_TestCase
{
    protected $context;
    protected $validator;

    protected function setUp()
    {
        $this->context = $this->getMock('Symfony\Component\Validator\ExecutionContext', array(), array(), '', false);
        $this->validator = new ContainsBadWordsValidator();
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

        $this->validator->validate(null, new ContainsBadWords());
    }

    public function testEmptyStringIsValid()
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $this->validator->validate('', new ContainsBadWords());
    }

    public function testSampleStringIsValid()
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $this->validator->validate('Hello world!', new ContainsBadWords());
    }

    public function testBadStringIsNotValid()
    {
        $this->context->expects($this->once())
            ->method('addViolation');

        $this->validator->validate('Hello pussy!', new ContainsBadWords());
    }

    /**
     * @expectedException Symfony\Component\Validator\Exception\UnexpectedTypeException
     */
    public function testExpectsStringCompatibleType()
    {
        $this->validator->validate(new \stdClass(), new ContainsBadWords());
    }
}