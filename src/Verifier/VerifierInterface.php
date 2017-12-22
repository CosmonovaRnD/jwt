<?php
declare(strict_types=1);

namespace CosmonovaRnD\JWT\Verifier;

use CosmonovaRnD\JWT\Token\TokenInterface;


/**
 * Interface VerifierInterface
 *
 * @author  Aleksandr Besedin <bs@cosmonova.net>
 * @package CosmonovaRnD\JWT
 * Cosmonova | Research & Development
 */
interface VerifierInterface
{
    /**
     * @param string         $expected
     * @param TokenInterface $token
     *
     * @return bool
     */
    public function verify(string $expected, TokenInterface $token): bool;
}
