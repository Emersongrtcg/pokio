<?php

namespace Pokio\Contracts;

use Closure;

interface Runtime
{
    /**
     * Defers the given callback to be executed.
     * @param  Closure  $callback  The function that will be executed.
     * @return  Result  The result object that processes the return of the callback.
     */
    public function defer(Closure $callback): Result;
}
