<?php

declare(strict_types=1);

namespace Pokio\Runtime\Sync;

use Closure;
use Pokio\Contracts\Result;

final readonly class SyncResult implements Result
{
    /**
     * Creates a new SyncResult instance.
     * @param  Closure  $callback  The function that will be runned.
     */
    public function __construct(private Closure $callback)
    {
        //
    }

    /**
     * Resolves the result.
     * @return  mixed  The return of the callback passed in the constructor.
     */
    public function get(): mixed
    {
        return ($this->callback)();
    }
}
