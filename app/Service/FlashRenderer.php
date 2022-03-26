<?php

namespace App\Service;

final class FlashRenderer
{
    public function renderErrorFlash(string $messageKey): void
    {
        flash(__($messageKey))->error();
    }

    public function renderSuccessFlash(string $messageKey): void
    {
        flash(__($messageKey))->success();
    }
}
