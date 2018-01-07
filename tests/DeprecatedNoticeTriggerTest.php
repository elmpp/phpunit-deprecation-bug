<?php

use PHPUnit\Framework\TestCase;

class DeprecatedNoticeTriggerTest extends TestCase {

    protected $subject;

    public function setUp() {
        $this->subject = new DeprecatedNoticeTrigger;
        @trigger_error('Bundle inheritance is deprecated as of 3.4 and will be removed in 4.0.', E_USER_DEPRECATED);
    }

    // passes as expected
    public function testTriggerDeprecatedNotice() {
        $this->assertTrue($this->subject->triggerDeprecatedNotice());
    }
    
    // the expected exception somehow surfaces the deprecated error. Notice
    // how the phpunit.xml.dist file specfies 
    // convertDeprecationsToExceptions="false"
    public function testTriggerDeprecatedNoticeWithExpectedExceptionTest() {
        
        $this->expectException(\RuntimeException::CLASS);
        $this->expectExceptionMessage("this is expected");
        
        $this->subject->triggerDeprecatedNoticeWithException();
    }
}