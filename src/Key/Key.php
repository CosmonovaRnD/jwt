<?php
declare(strict_types=1);

namespace CosmonovaRnD\JWT\Key;

/**
 * Class Key
 *
 * @author  Aleksandr Besedin <bs@cosmonova.net>
 * @package CosmonovaRnD\JWT\Key
 * Cosmonova | Research & Development
 */
class Key implements KeyInterface
{
    /**
     * @var string
     */
    protected $content;
    /**
     * @var string
     */
    protected $passphrase;

    /**
     * SignKey constructor.
     *
     * @param string $content
     * @param string $passphrase
     */
    public function __construct(string $content, string $passphrase)
    {
        $this->content    = $content;
        $this->passphrase = $passphrase;
    }

    /**
     * @return string
     */
    public function content(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function passphrase(): string
    {
        return $this->passphrase;
    }
}
