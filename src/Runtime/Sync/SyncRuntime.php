<?php

namespace Pokio\Runtime\Sync;

use Closure;
use Pokio\Contracts\Result;
use Pokio\Contracts\Runtime;

final readonly class SyncRuntime implements Runtime
{
    /**
     * Defers the given callback to be executed synchronously.
     * @param  Closure  $callback  The callback that will be executed.
     * @return  SyncResult  The result object that processes the return of the callback.
     */
    public function defer(Closure $callback): Result
    {
        return new SyncResult($callback);
    }
}
