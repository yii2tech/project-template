<?php

namespace tests\unit\validators;

use app\validators\PasswordValidator;
use tests\unit\TestCase;

class PasswordValidatorTest extends TestCase
{
    /**
     * @return array test data
     */
    public function dataProviderValidate()
    {
        return [
            ['123456', false],
            ['password', false],
            ['1ba#', false],
            ['weakpassword', false],
            ['Strong4@password', true],
        ];
    }

    /**
     * @dataProvider dataProviderValidate
     *
     * @param string $value
     * @param boolean $expectedResult
     */
    public function testValidate($value, $expectedResult)
    {
        $validator = new PasswordValidator();
        $this->assertEquals($expectedResult, $validator->validate($value));
    }
}