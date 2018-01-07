<?php

class DeprecatedNoticeTrigger {
    
    public function triggerDeprecatedNotice() {
        // as experienced in https://github.com/symfony/symfony/blob/3.4/src/Symfony/Component/HttpKernel/Kernel.php#L502
        @trigger_error('Bundle inheritance is deprecated as of 3.4 and will be removed in 4.0.', E_USER_DEPRECATED);
        return true;
    }
    
    public function triggerDeprecatedNoticeWithException() {
        // as experienced in https://github.com/symfony/symfony/blob/3.4/src/Symfony/Component/HttpKernel/Kernel.php#L502
        @trigger_error('Bundle inheritance is deprecated as of 3.4 and will be removed in 4.0.', E_USER_DEPRECATED);
        throw new \RuntimeException("this is expected");
    }
    
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