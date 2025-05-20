<?php

use Pokio\Promise;

if (! function_exists('async')) {
    /**
     * Runs a callback asynchronously and returns a promise.
     * @param  Closure  $callback  The function that will be runned asynchronously.
     * @return  Promisse  A Promise object must be passed as parameter of await() to get the return of the callback.
     */
    function async(Closure $callback): Promise
    {
        $promise = new Promise($callback);

        $promise->run();

        return $promise;
    }
}

if (! function_exists('await')) {
    /**
     * Awaits the resolution of a() promise(s).
     *
     * @param  array<int, Promise>|Promise  $promises  The Promise object, or a array of Promises, created by async().
     * @return  mixed  Gives the return of the Promise's callback, if a Promise is passed, or an array of returns, if an array of Promises is passed.
     */
    function await(array|Promise $promises): mixed
    {
        if (! is_array($promises)) {
            return $promises->resolve();
        }

        return array_map(
            static fn (Promise $promise): mixed => $promise->resolve(),
            $promises
        );
    }
}
