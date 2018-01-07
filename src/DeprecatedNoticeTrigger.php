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
}