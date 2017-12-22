<?php
declare(strict_types=1);

namespace CosmonovaRnD\JWT\Key;

/**
 * Interface KeyInterface
 *
 * @author  Aleksandr Besedin <bs@cosmonova.net>
 * @package CosmonovaRnD\JWT\Key
 * Cosmonova | Research & Development
 */
interface KeyInterface
{
    /**
     * @return string
     */
    public function content(): string;

    /**
     * @return string
     */
    public function passphrase(): string;
}
