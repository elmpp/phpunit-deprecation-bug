<?php

use PHPUnit\Framework\TestCase;

class DeprecatedNoticeTriggerTest extends TestCase {

    protected $subject;

    public function setUp() {
        $this->subject = new DeprecatedNoticeTrigger;

        // as experienced in https://github.com/symfony/symfony/blob/3.4/src/Symfony/Component/HttpKernel/Kernel.php#L502
        // and normally thrown as part of the symfony KernelWebTest bootstrapping in setUp()
        @trigger_error('Bundle inheritance is deprecated as of 3.4 and will be removed in 4.0.', E_USER_DEPRECATED);
    }

    public function testTriggerDeprecatedNoticeAlongsideCustomErrorHandler($dummy) {
        
        $this->expectException(\RuntimeException::CLASS);
        $this->expectExceptionMessage("This should be the exception message that is expected");
        
        $this->subject->triggerDeprecatedNoticeWithExceptionAndCustomErrorHandler();
    }

    /**
     * The dataProvider use seems to be the root cause here
     * 
     * @dataProvider dataProvider
     */
    public function testTriggerDeprecatedNoticeAlongsideCustomErrorHandlerWithDataProvider(String $dummy) {
        
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