<?php

namespace Pokio\Contracts;

interface Result
{
    /**
     * Gets the return of the operation.
     */
    public function get(): mixed;
}
