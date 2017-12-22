<?php
declare(strict_types=1);

namespace CosmonovaRnD\JWT\Token;

/**
 * Interface TokenInterface
 *
 * @author  Aleksandr Besedin <bs@cosmonova.net>
 * @package CosmonovaRnD\JWT
 * Cosmonova | Research & Development
 */
interface TokenInterface
{
    /**
     * @return array
     */
    public function headers(): array;

    /**
     * @param string $key
     *
     * @return null|string
     */
    public function header(string $key): ?string;

    /**
     * @return array
     */
    public function claims(): array;

    /**
     * @param string $key
     *
     * @return null|string
     */
    public function claim(string $key): ?string;

    /**
     * @return string
     */
    public function payload(): string;

    /**
     * @return string
     */
    public function type(): string;

    /**
     * @return string
     */
    public function algorithm(): string;

    /**
     * @return null|string
     */
    public function identifier(): ?string;

    /**
     * @return array
     */
    public function audience(): array;

    /**
     * @return \DateTimeInterface|null
     */
    public function expires(): ?\DateTimeInterface;

    /**
     * @return \DateTimeInterface|null
     */
    public function issuedAt(): ?\DateTimeInterface;

    /**
     * @return null|string
     */
    public function issuer(): ?string;

    /**
     * @return \DateTimeInterface|null
     */
    public function notBefore(): ?\DateTimeInterface;

    /**
     * @return null|string
     */
    public function subject(): ?string;

    /**
     * @return null|string
     */
    public function signature(): ?string;

    /**
     * @return string
     */
    public function __toString(): string;
}
