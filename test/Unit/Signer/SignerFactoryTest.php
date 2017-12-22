<?php
declare(strict_types=1);

namespace CosmonovaRnD\JWT\Test\Unit\Signer;

use CosmonovaRnD\JWT\Exception\NotSupportedAlgorithmException;
use CosmonovaRnD\JWT\Signer\SignerFactory;
use Lcobucci\JWT\Signer\Hmac\Sha256 as HmacSha256;
use Lcobucci\JWT\Signer\Hmac\Sha384 as HmacSha384;
use Lcobucci\JWT\Signer\Hmac\Sha512 as HmacSha512;
use Lcobucci\JWT\Signer\Rsa\Sha256 as RsaSha256;
use Lcobucci\JWT\Signer\Rsa\Sha384 as RsaSha384;
use Lcobucci\JWT\Signer\Rsa\Sha512 as RsaSha512;
use PHPUnit\Framework\TestCase;

/**
 * Class SignerFactory
 *
 * @author  Aleksandr Besedin <bs@cosmonova.net>
 * @package CosmonovaRnD\JWT\Test\Unit\Signer
 * Cosmonova | Research & Development
 */
class SignerFactoryTest extends TestCase
{
    /**
     * @throws \CosmonovaRnD\JWT\Exception\NotSupportedAlgorithmException
     */
    public function testReturnValidSignerObjectByAlgorithmId(): void
    {
        $factory = new SignerFactory();

        $this->assertInstanceOf(RsaSha256::class, $factory->create('RS256'));
        $this->assertInstanceOf(RsaSha384::class, $factory->create('RS384'));
        $this->assertInstanceOf(RsaSha512::class, $factory->create('RS512'));
        $this->assertInstanceOf(HmacSha256::class, $factory->create('HS256'));
        $this->assertInstanceOf(HmacSha384::class, $factory->create('HS384'));
        $this->assertInstanceOf(HmacSha512::class, $factory->create('HS512'));
    }

    /**
     * @throws \CosmonovaRnD\JWT\Exception\NotSupportedAlgorithmException
     */
    public function testThrowExceptionOnUnsupportedAlgorithm(): void
    {
        $factory = new SignerFactory();

        $this->expectException(NotSupportedAlgorithmException::class);

        $factory->create('non-supported-algo');
    }
}
