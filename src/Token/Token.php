<?php
declare(strict_types=1);

namespace CosmonovaRnD\JWT\Token;

/**
 * Class Token
 *
 * @author  Aleksandr Besedin <bs@cosmonova.net>
 * @package CosmonovaRnD\JWT\Token
 * Cosmonova | Research & Development
 */
final class Token implements TokenInterface
{
    /**
     * @var \Lcobucci\JWT\Token
     */
    private $token;

    /**
     * Token constructor.
     *
     * @param \Lcobucci\JWT\Token $token
     */
    public function __construct(\Lcobucci\JWT\Token $token)
    {
        $this->token = $token;
    }

    /**
     * @return array
     */
    public function headers(): array
    {
        return $this->token->headers()->all();
    }

    /**
     * @param string $key
     *
     * @return null|string
     */
    public function header(string $key): ?string
    {
        return $this->token->headers()->get($key);
    }

    /**
     * @return array
     */
    public function claims(): array
    {
        return $this->token->claims()->all();
    }

    /**
     * @param string $key
     *
     * @return null|string
     */
    public function claim(string $key): ?string
    {
        return $this->token->claims()->get($key);
    }

    /**
     * @return string
     */
    public function payload(): string
    {
        return $this->token->payload();
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return (string)$this->token->headers()->get('typ', 'JWT');
    }

    /**
     * @return string
     */
    public function algorithm(): string
    {
        return (string)$this->token->headers()->get('alg', 'none');
    }

    /**
     * @return null|string
     */
    public function identifier(): ?string
    {
        return $this->token->claims()->get('jti');
    }

    /**
     * @return array
     */
    public function audience(): array
    {
        return $this->token->claims()->get('aud');
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function expires(): ?\DateTimeInterface
    {
        $expires = $this->token->claims()->get('exp');

        return \DateTimeImmutable::createFromFormat('U', $expires);
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function issuedAt(): ?\DateTimeInterface
    {
        $issuedAt = $this->token->claims()->get('iat');

        return \DateTimeImmutable::createFromFormat('U', $issuedAt);
    }

    /**
     * @return null|string
     */
    public function issuer(): ?string
    {
        return $this->token->claims()->get('iss');
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function notBefore(): ?\DateTimeInterface
    {
        return $this->token->claims()->get('nbf');
    }

    /**
     * @return null|string
     */
    public function subject(): ?string
    {
        return $this->token->claims()->get('sub');
    }

    /**
     * @return null|string
     */
    public function user(): ?string
    {
        return $this->token->claims()->get('usr');
    }

    /**
     * @return array
     */
    public function roles(): array
    {
        $roles = $this->token->claims()->get('roles');

        if (empty($roles)) {
            return [];
        }

        return \explode(',', $roles);
    }

    /**
     * @return string
     */
    public function signature(): string
    {
        return $this->token->signature()->hash();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->token;
    }
}
