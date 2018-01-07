<?php

class DeprecatedNoticeTrigger {
    
    public function triggerDeprecatedNoticeWithExceptionAndCustomErrorHandler() {
        
        set_error_handler(function($errno, $errstr, $errfile, $errline, array $errcontext) {
            throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
        });
        try {
            @trigger_error('This should be the exception message that is expected', E_USER_WARNING);
        }
        catch (\Throwable $e) { // in this case would be our \ErrorException
            throw new \RuntimeException($e->getMessage());
        }
        restore_error_handler();
    }
}