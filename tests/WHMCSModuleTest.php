<?php
/**
 * WHMCS Sample Addon Module Test
 *
 * Sample PHPUnit test that asserts the fundamental requirements of a WHMCS
 * module, ensuring that the required config function is defined and contains
 * the required array keys.
 *
 * This is by no means intended to be a complete test, and does not exercise any
 * of the actual functionality of the functions within the module. We strongly
 * recommend you implement further tests as appropriate for your module use
 * case.
 *
 * @copyright Copyright (c) WHMCS Limited 2017
 * @license http://www.whmcs.com/license/ WHMCS Eula
 */
class WHMCSModuleTest extends PHPUnit_Framework_TestCase
{
    /** @var string $moduleName */
    protected $moduleName = 'addonmodule';

    /**
     * Asserts the required config options function is defined.
     */
    public function testRequiredConfigOptionsFunctionExists()
    {
        $this->assertTrue(function_exists($this->moduleName . '_config'));
    }

    /**
     * Asserts the required config option array keys are present.
     */
    public function testRequiredConfigOptionsParametersAreDefined()
    {
        $result = call_user_func($this->moduleName . '_config');

        $this->assertArrayHasKey('name', $result);
        $this->assertArrayHasKey('description', $result);
        $this->assertArrayHasKey('author', $result);
        $this->assertArrayHasKey('language', $result);
        $this->assertArrayHasKey('version', $result);
        $this->assertArrayHasKey('fields', $result);
    }
}
