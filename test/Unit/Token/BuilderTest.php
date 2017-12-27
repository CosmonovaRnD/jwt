<?php
declare(strict_types=1);

namespace CosmonovaRnD\JWT\Test\Unit\Token;

use CosmonovaRnD\JWT\Key\SignKey;
use CosmonovaRnD\JWT\Signer\SignerFactory;
use CosmonovaRnD\JWT\Token\Builder;
use CosmonovaRnD\JWT\Token\TokenInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class BuilderTest
 *
 * @author  Aleksandr Besedin <bs@cosmonova.net>
 * @package CosmonovaRnD\JWT\Test\Unit\Token
 * Cosmonova | Research & Development
 */
class BuilderTest extends TestCase
{
    private $key;

    private function loadKey()
    {
        $key        = file_get_contents(__DIR__ . '/../key.pem');
        $passphrase = file_get_contents(__DIR__ . '/../passphrase.txt');

        $this->key = new SignKey($key, $passphrase);
    }

    /**
     * @throws \CosmonovaRnD\JWT\Exception\NotSupportedAlgorithmException
     */
    public function testGetToken(): void
    {
        $this->loadKey();

        $audience   = 'test_audience';
        $issuedAt   = new \DateTimeImmutable('01.01.2017 00:00:00');
        $expiresIn  = new \DateTimeImmutable('01.01.2030 00:00:00');
        $identifier = '1234';
        $uid = '123123123';
        $user       = 'test_username';
        $roles      = ['ROLE_ADMIN', 'ROLE_MANAGER'];

        $builder = new Builder();
        $token   = $builder
            ->addAudience($audience)
            ->identifiedBy($identifier)
            ->issuedAt($issuedAt)
            ->algorithm('RS256')
            ->expiresAt($expiresIn)
            ->uid($uid)
            ->user($user)
            ->roles($roles)
            ->getToken(new SignerFactory(), $this->key);

        $this->assertInstanceOf(TokenInterface::class, $token);
        $this->assertArraySubset([$audience], $token->audience());
        $this->assertEquals($issuedAt, $token->issuedAt());
        $this->assertEquals($identifier, $token->identifier());
        $this->assertEquals($expiresIn, $token->expires());
        $this->assertEquals($uid, $token->uid());
        $this->assertEquals($user, $token->user());
        $this->assertEquals($roles, $token->roles());
    }
}
