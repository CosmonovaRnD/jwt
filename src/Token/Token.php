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
        return (string)$this->token->headers()->get(Headers::TYPE, 'JWT');
    }

    /**
     * @return string
     */
    public function algorithm(): string
    {
        return (string)$this->token->headers()->get(Headers::ALGORITHM, 'none');
    }

    /**
     * @return null|string
     */
    public function identifier(): ?string
    {
        return $this->token->claims()->get(Claims::ID);
    }

    /**
     * @return array
     */
    public function audience(): array
    {
        return $this->token->claims()->get(Claims::AUDIENCE);
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function expires(): ?\DateTimeInterface
    {
        return $this->token->claims()->get(Claims::EXPIRATION_TIME);
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function issuedAt(): ?\DateTimeInterface
    {
        return $this->token->claims()->get(Claims::ISSUED_AT);
    }

    /**
     * @return null|string
     */
    public function issuer(): ?string
    {
        return $this->token->claims()->get(Claims::ISSUER);
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function notBefore(): ?\DateTimeInterface
    {
        return $this->token->claims()->get(Claims::NOT_BEFORE);
    }

    /**
     * @return null|string
     */
    public function subject(): ?string
    {
        return $this->token->claims()->get(Claims::SUBJECT);
    }

    /**
     * @return null|string
     */
    public function uid(): ?string
    {
        return $this->token->claims()->get(Claims::USER_ID);
    }

    /**
     * @return null|string
     */
    public function aid(): ?string
    {
        return $this->token->claims()->get(Claims::APP_ID);
    }

    /**
     * @return null|string
     */
    public function user(): ?string
    {
        return $this->token->claims()->get(Claims::USER);
    }

    /**
     * @return array
     */
    public function roles(): array
    {
        $roles = $this->token->claims()->get(Claims::ROLES);

        if (empty($roles)) {
            return [];
        }

        return $roles;
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
