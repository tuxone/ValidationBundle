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
        $this->validator = new NotContainsBadWordsValidator(__DIR__."/../../../Dictionaries/list.txt");
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

    /**
     * @dataProvider getValidStringInput
     */
    public function testSampleStringIsValid($validInput)
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $this->validator->validate($validInput, new NotContainsBadWords());
    }

    /**
     * @dataProvider getNotValidStringInput
     */
    public function testBadStringIsNotValid($notValidInput)
    {
        $this->context->expects($this->once())
            ->method('addViolation');

        $this->validator->validate($notValidInput, new NotContainsBadWords());
    }

    public function getNotValidStringInput()
    {
        return array(
            array('Hello Pussy'),
            array('Pussy hello'),
            array('Shit pussy'),
            array('Hi shit'),
        );
    }

    public function getValidStringInput()
    {
        return array(
            array('Hello Passy'),
            array('hi shot'),
            array('Shot this'),
            array('This drink is awesome'),
        );
    }

    /**
     * @expectedException Symfony\Component\Validator\Exception\UnexpectedTypeException
     */
    public function testExpectsStringCompatibleType()
    {
        $this->validator->validate(new \stdClass(), new NotContainsBadWords());
    }
}
