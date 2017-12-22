<?php
declare(strict_types=1);

namespace CosmonovaRnD\JWT\Signer;

use CosmonovaRnD\JWT\Exception\NotSupportedAlgorithmException;
use Lcobucci\JWT\Signer\Hmac\Sha256 as HmacSha256;
use Lcobucci\JWT\Signer\Hmac\Sha384 as HmacSha384;
use Lcobucci\JWT\Signer\Hmac\Sha512 as HmacSha512;
use Lcobucci\JWT\Signer\Rsa\Sha256 as RsaSha256;
use Lcobucci\JWT\Signer\Rsa\Sha384 as RsaSha384;
use Lcobucci\JWT\Signer\Rsa\Sha512 as RsaSha512;

/**
 * Class SignerFactory
 *
 * @author  Aleksandr Besedin <bs@cosmonova.net>
 * @package CosmonovaRnD\JWT\Signer
 * Cosmonova | Research & Development
 */
class SignerFactory
{
    const RSA_SHA256 = 'RS256';
    const RSA_SHA384 = 'RS384';
    const RSA_SHA512 = 'RS512';

    const HMAC_SHA256 = 'HS256';
    const HMAC_SHA384 = 'HS384';
    const HMAC_SHA512 = 'HS512';

    const ECDSA_SHA256 = 'ES256';
    const ECDSA_SHA384 = 'ES384';
    const ECDSA_SHA512 = 'ES512';

    const ALL = [
        self::RSA_SHA256,
        self::RSA_SHA384,
        self::RSA_SHA512,
        self::HMAC_SHA256,
        self::HMAC_SHA384,
        self::HMAC_SHA512,
        //        Unsupported yet
        //        self::ECDSA_SHA256,
        //        self::ECDSA_SHA384,
        //        self::ECDSA_SHA512,
    ];

    const MAP = [
        self::RSA_SHA256  => RsaSha256::class,
        self::RSA_SHA384  => RsaSha384::class,
        self::RSA_SHA512  => RsaSha512::class,
        self::HMAC_SHA256 => HmacSha256::class,
        self::HMAC_SHA384 => HmacSha384::class,
        self::HMAC_SHA512 => HmacSha512::class,
        //        Unsupported yet
        //        self::ECDSA_SHA256 => EcdsaSha256::class,
        //        self::ECDSA_SHA384 => EcdsaSha384::class,
        //        self::ECDSA_SHA512 => EcdsaSha512::class,
    ];

    /**
     * @param string $algoId Algorithm ID
     *
     * @return \Lcobucci\JWT\Signer
     * @throws \CosmonovaRnD\JWT\Exception\NotSupportedAlgorithmException
     */
    public function create(string $algoId): \Lcobucci\JWT\Signer
    {
        $algoId = strtoupper($algoId);

        if (!isset(self::MAP[$algoId])) {
            throw new NotSupportedAlgorithmException();
        }

        $class = self::MAP[$algoId];

        return new $class;
    }
}
