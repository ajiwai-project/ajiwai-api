<?php

namespace Ajiwai\Library;

use Illuminate\Support\Facades\Log;

function assert(bool $value, string $message = 'this is uncorrect value.')
{
    if ($value) return;

    Log::error('AssertionError:'.$message);
}
