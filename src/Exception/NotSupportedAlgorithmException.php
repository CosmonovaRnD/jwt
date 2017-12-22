<?php
declare(strict_types=1);

namespace CosmonovaRnD\JWT\Exception;

/**
 * Class NotSupportedAlgorithmException
 *
 * @author  Aleksandr Besedin <bs@cosmonova.net>
 * @package CosmonovaRnD\JWT\Exception
 * Cosmonova | Research & Development
 */
class NotSupportedAlgorithmException extends Exception
{
    /**
     * NotSupportedAlgorithmException constructor.
     *
     * @param int             $code
     * @param \Throwable|null $previous
     */
    public function __construct(int $code = 0, \Throwable $previous = null)
    {
        $message = 'Algorithm doesn\'t supported';
        parent::__construct($message, $code, $previous);
    }
}
