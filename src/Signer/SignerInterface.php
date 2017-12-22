<?php
declare(strict_types=1);

namespace CosmonovaRnD\JWT\Signer;

use CosmonovaRnD\JWT\Token\TokenInterface;

/**
 * Interface SignerInterface
 *
 * @author  Aleksandr Besedin <bs@cosmonova.net>
 * @package CosmonovaRnD\JWT
 * Cosmonova | Research & Development
 */
interface SignerInterface
{
    /**
     * @param \CosmonovaRnD\JWT\Token\TokenInterface $token
     *
     * @return string
     */
    public function sign(TokenInterface $token): string;
}
