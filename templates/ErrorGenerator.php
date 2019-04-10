<?php

namespace templates;

class ErrorGenerator
{
    public function getError($errorMsg)
    {
        if (isset($errorMsg)): ?>
            <p class="error-msg"><?php echo $errorMsg ?></p>
        <?php endif;
    }
}