<?php
declare(strict_types=1);

namespace CosmonovaRnD\JWT\Signer;

use CosmonovaRnD\JWT\Key\SignKey;
use CosmonovaRnD\JWT\Token\TokenInterface;
use Lcobucci\JWT\Signer\Key;

/**
 * Class Signer
 *
 * @author  Aleksandr Besedin <bs@cosmonova.net>
 * @package CosmonovaRnD\JWT\Signer
 * Cosmonova | Research & Development
 */
final class Signer implements SignerInterface
{
    /**
     * @var \CosmonovaRnD\JWT\Signer\SignerFactory
     */
    private $factory;
    /**
     * @var \CosmonovaRnD\JWT\Key\SignKey
     */
    private $signKey;

    /**
     * Signer constructor.
     *
     * @param \CosmonovaRnD\JWT\Signer\SignerFactory $factory
     * @param \CosmonovaRnD\JWT\Key\SignKey          $signKey
     */
    public function __construct(SignerFactory $factory, SignKey $signKey)
    {
        $this->factory = $factory;
        $this->signKey = $signKey;
    }

    /**
     * @param \CosmonovaRnD\JWT\Token\TokenInterface $token
     *
     * @return string
     * @throws \CosmonovaRnD\JWT\Exception\NotSupportedAlgorithmException
     */
    public function sign(TokenInterface $token): string
    {
        $signer = $this->factory->create($token->algorithm());
        $key    = new Key($this->signKey->content(), $this->signKey->passphrase());

        return $signer->sign($token->payload(), $key);
    }
}
