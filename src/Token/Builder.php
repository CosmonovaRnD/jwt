<?php
declare(strict_types=1);

namespace CosmonovaRnD\JWT\Token;

use CosmonovaRnD\JWT\Key\SignKey;
use CosmonovaRnD\JWT\Signer\SignerFactory;
use Lcobucci\Jose\Parsing\Parser;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Token\DataSet;
use Lcobucci\JWT\Token\Plain;
use Lcobucci\JWT\Token\Signature;

/**
 * Class Builder
 *
 * @author  Aleksandr Besedin <bs@cosmonova.net>
 * @package CosmonovaRnD\JWT\Token
 * Cosmonova | Research & Development
 */
class Builder
{
    private $headers = [Headers::TYPE => 'JWT', Headers::ALGORITHM => 'none'];

    private $claims = [];

    /**
     * @param string $algorithmId
     *
     * @return \CosmonovaRnD\JWT\Token\Builder
     */
    public function algorithm(string $algorithmId): Builder
    {
        $this->headers[Headers::ALGORITHM] = $algorithmId;

        return $this;
    }

    /**
     * @param string $audience
     *
     * @return \CosmonovaRnD\JWT\Token\Builder
     */
    public function addAudience(string $audience): Builder
    {
        $audiences = $this->claims[Claims::AUDIENCE] ?? [];

        if (!\in_array($audience, $audiences)) {
            $audiences[] = $audience;
        }

        $this->claims[Claims::AUDIENCE] = $audiences;

        return $this;
    }

    /**
     * @param \DateTimeImmutable $expiration
     *
     * @return \CosmonovaRnD\JWT\Token\Builder
     */
    public function expiresAt(\DateTimeImmutable $expiration): Builder
    {
        $this->claims[Claims::EXPIRATION_TIME] = $expiration;

        return $this;
    }

    /**
     * @param string $id
     *
     * @return \CosmonovaRnD\JWT\Token\Builder
     */
    public function identifiedBy(string $id): Builder
    {
        $this->claims[Claims::ID] = $id;

        return $this;
    }

    /**
     * @param \DateTimeImmutable $issuedAt
     *
     * @return \CosmonovaRnD\JWT\Token\Builder
     */
    public function issuedAt(\DateTimeImmutable $issuedAt): Builder
    {
        $this->claims[Claims::ISSUED_AT] = $issuedAt;

        return $this;
    }

    /**
     * @param string $issuer
     *
     * @return \CosmonovaRnD\JWT\Token\Builder
     */
    public function issuedBy(string $issuer): Builder
    {
        $this->claims[Claims::ISSUER] = $issuer;

        return $this;
    }

    /**
     * @param string $uid
     *
     * @return \CosmonovaRnD\JWT\Token\Builder
     */
    public function uid(string $uid): Builder
    {
        $this->claims[Claims::USER_ID] = $uid;

        return $this;
    }

    /**
     * @param string $aid
     *
     * @return \CosmonovaRnD\JWT\Token\Builder
     */
    public function aid(string $aid): Builder
    {
        $this->claims[Claims::APP_ID] = $aid;

        return $this;
    }

    /**
     * @param string $user
     *
     * @return \CosmonovaRnD\JWT\Token\Builder
     */
    public function user(string $user): Builder
    {
        $this->claims[Claims::USER] = $user;

        return $this;
    }

    /**
     * @param array $roles
     *
     * @return \CosmonovaRnD\JWT\Token\Builder
     */
    public function roles(array $roles): Builder
    {
        $this->claims[Claims::ROLES] = $roles;

        return $this;
    }

    /**
     * @param string $name
     * @param        $value
     *
     * @return \CosmonovaRnD\JWT\Token\Builder
     */
    public function withHeader(string $name, $value): Builder
    {
        $this->headers[$name] = $value;

        return $this;
    }

    /**
     * @param string $name
     * @param        $value
     *
     * @return \CosmonovaRnD\JWT\Token\Builder
     */
    public function withClaim(string $name, $value): Builder
    {
        $this->claims[$name] = $value;

        return $this;
    }

    /**
     * @param \CosmonovaRnD\JWT\Signer\SignerFactory $factory
     * @param \CosmonovaRnD\JWT\Key\SignKey          $signKey
     *
     * @return \CosmonovaRnD\JWT\Token\Token
     * @throws \CosmonovaRnD\JWT\Exception\NotSupportedAlgorithmException
     */
    public function getToken(SignerFactory $factory, SignKey $signKey): Token
    {
        $signer  = $factory->create($this->headers[Headers::ALGORITHM]);
        $encoder = new Parser();

        $encodedHeaders = $encoder->base64UrlEncode($encoder->jsonEncode($this->headers));
        $encodedClaims  = $encoder->base64UrlEncode($encoder->jsonEncode($this->buildClaims($this->claims)));
        $key            = new Key($signKey->content(), $signKey->passphrase());

        $signature        = $signer->sign($encodedHeaders . '.' . $encodedClaims, $key);
        $encodedSignature = $encoder->base64UrlEncode($signature);

        return new Token(new Plain(
                             new DataSet($this->headers, $encodedHeaders),
                             new DataSet($this->claims, $encodedClaims),
                             new Signature($signature, $encodedSignature)
                         ));
    }

    /**
     * @param array $claims
     *
     * @return array
     */
    private function buildClaims(array $claims): array
    {
        $newClaims = [];

        foreach ($claims as $key => $claim) {
            if (in_array($key, [Claims::ISSUED_AT, Claims::EXPIRATION_TIME])) {
                $newClaims[$key] = $claim->format('U');
            } else {
                $newClaims[$key] = $claim;
            }
        }

        return $newClaims;
    }
}
