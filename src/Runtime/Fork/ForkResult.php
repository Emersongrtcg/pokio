<?php

namespace Pokio\Runtime\Fork;

use Pokio\Contracts\Result;

/**
 * Represents the result of a forked process.
 */
final class ForkResult implements Result
{
    /**
     * The result of the forked process, if any.
     */
    private mixed $result = null;

    /**
     * Indicates whether the result has been resolved.
     */
    private bool $resolved = false;

    /**
     * Creates a new fork result instance.
     * @param  string  $pipePath  The path to the pipe were the result was stored.
     */
    public function __construct(
        private readonly string $pipePath,
    ) {
        //
    }

    /**
     * Gets the result of the asynchronous operation.
     * @return  mixed  The return stored in the pipe path passed in the constructor.
     */
    public function get(): mixed
    {
        if ($this->resolved) {
            return $this->result;
        }

        $pipe = fopen($this->pipePath, 'r');

        stream_set_blocking($pipe, true);
        $serialized = stream_get_contents($pipe);
        fclose($pipe);

        if (file_exists($this->pipePath)) {
            unlink($this->pipePath);
        }

        $this->resolved = true;

        return $this->result = unserialize($serialized);
    }
}
