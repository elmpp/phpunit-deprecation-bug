<?php

use PHPUnit\Framework\TestCase;

class DeprecatedNoticeTriggerTest extends TestCase {

    protected $subject;

    public function setUp() {
        $this->subject = new DeprecatedNoticeTrigger;

        // as experienced in https://github.com/symfony/symfony/blob/3.4/src/Symfony/Component/HttpKernel/Kernel.php#L502
        // and normally thrown as part of the symfony KernelWebTest bootstrapping in setUp()
        // @trigger_error('Bundle inheritance is deprecated as of 3.4 and will be removed in 4.0.', E_USER_DEPRECATED);
    }
    
    
    /**
     * Custom error handling seems legit
     */
    public function testCustomErrorHandler() {
        
        $this->expectException(\RuntimeException::CLASS);
        $this->expectExceptionMessage("This should be the exception message that is expected");
        
        $this->subject->triggerDeprecatedNoticeWithExceptionAndCustomErrorHandler();
    }
    
    /**
     * Custom error handling seems legit with deprecated error
     */
    public function testCustomErrorHandlerAndDeprecatedError() {
        
        // as experienced in https://github.com/symfony/symfony/blob/3.4/src/Symfony/Component/HttpKernel/Kernel.php#L502
        // and normally thrown as part of the symfony KernelWebTest bootstrapping in setUp()
        @trigger_error('Bundle inheritance is deprecated as of 3.4 and will be removed in 4.0.', E_USER_DEPRECATED);
        
        $this->expectException(\RuntimeException::CLASS);
        $this->expectExceptionMessage("This should be the exception message that is expected");
        
        $this->subject->triggerDeprecatedNoticeWithExceptionAndCustomErrorHandler();
    }
    
    /**
     * Custom error handling seems legit alongside dataProvider
     * 
     * @dataProvider dataProvider
     */
    public function testCustomErrorHandlerWithDataProvider(String $dummy) {
        
        $this->expectException(\RuntimeException::CLASS);
        $this->expectExceptionMessage("This should be the exception message that is expected");
        
        $this->subject->triggerDeprecatedNoticeWithExceptionAndCustomErrorHandler();
    }

    /**
     * The deprecated error alongside dataProvider seems to be the cause of these unexpected failures
     * Please note how the phpunit.xml shows 
     * convertDeprecationsToExceptions="false"
     * It also does not seem to affect the result here also
     * 
     * @dataProvider dataProvider
     */
    public function testCustomErrorHandlerWithDataProviderAndDeprecatedError(String $dummy) {
        
        // as experienced in https://github.com/symfony/symfony/blob/3.4/src/Symfony/Component/HttpKernel/Kernel.php#L502
        // and normally thrown as part of the symfony KernelWebTest bootstrapping in setUp()
        @trigger_error('Bundle inheritance is deprecated as of 3.4 and will be removed in 4.0.', E_USER_DEPRECATED);
        
        $this->expectException(\RuntimeException::CLASS);
        $this->expectExceptionMessage("This should be the exception message that is expected");
        
        $this->subject->triggerDeprecatedNoticeWithExceptionAndCustomErrorHandler();
    }
    

    public function dataProvider() {
        return [
            ['dummy'],
            ['dummy'],
            ['dummy'],
        ];
    }
}