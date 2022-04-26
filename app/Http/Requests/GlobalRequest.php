<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

class GlobalRequest extends Request
{
    public function expectsJson(): bool
    {
        return true;
    }

    public function wantsJson(): bool
    {
        return true;
    }
}
