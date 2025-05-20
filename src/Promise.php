<?php

declare(strict_types=1);

namespace Pokio;

use Closure;
use Pokio\Contracts\Result;

final readonly class Promise
{
    private Result $result;

    /**
     * Creates a new Promise instance.
     * @param  Closure  $callback  The function that will be runned asynchronously.
     */
    public function __construct(private Closure $callback)
    {
        //
    }

    /**
     * Runs the callback and saves the return.
     */
    public function run(): void
    {
        $runtime = Environment::runtime();

        $this->result = $runtime->defer($this->callback);
    }

    /**
     * Resolves the promise.
     * @return  mixed  The return of the callback runned asynchronously.
     */
    public function resolve(): mixed
    {
        return $this->result->get();
    }
}
