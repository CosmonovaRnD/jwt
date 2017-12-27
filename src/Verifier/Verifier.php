<?php
declare(strict_types=1);

namespace CosmonovaRnD\JWT\Verifier;

use CosmonovaRnD\JWT\Key\VerifyKey;
use CosmonovaRnD\JWT\Signer\SignerFactory;
use CosmonovaRnD\JWT\Token\TokenInterface;
use Lcobucci\JWT\Signer\Key;

/**
 * Class Verifier
 *
 * @author  Aleksandr Besedin <bs@cosmonova.net>
 * @package CosmonovaRnD\JWT\Verifier
 * Cosmonova | Research & Development
 */
final class Verifier implements VerifierInterface
{
    /**
     * @var \CosmonovaRnD\JWT\Key\VerifyKey
     */
    private $verifyKey;
    /**
     * @var \CosmonovaRnD\JWT\Signer\SignerFactory
     */
    private $factory;

    /**
     * Verifier constructor.
     *
     * @param \CosmonovaRnD\JWT\Signer\SignerFactory $factory
     * @param \CosmonovaRnD\JWT\Key\VerifyKey        $verifyKey
     */
    public function __construct(SignerFactory $factory, VerifyKey $verifyKey)
    {
        $this->factory   = $factory;
        $this->verifyKey = $verifyKey;
    }

    /**
     * @param \CosmonovaRnD\JWT\Token\TokenInterface $token
     *
     * @return bool
     * @throws \CosmonovaRnD\JWT\Exception\NotSupportedAlgorithmException
     */
    public function verify(TokenInterface $token): bool
    {
        $signer = $this->factory->create($token->algorithm());
        $key    = new Key($this->verifyKey->content(), $this->verifyKey->passphrase());

        return $signer->verify($token->signature(), $token->payload(), $key);
    }
}
