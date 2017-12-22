<?php
declare(strict_types=1);

namespace CosmonovaRnD\JWT\Parser;

use CosmonovaRnD\JWT\Token\TokenInterface;

/**
 * Interface ParserInterface
 *
 * @author  Aleksandr Besedin <bs@cosmonova.net>
 * @package CosmonovaRnD\JWT
 * Cosmonova | Research & Development
 */
interface ParserInterface
{
    /**
     * @param string $jwt
     *
     * @return \CosmonovaRnD\JWT\Token\TokenInterface
     */
    public function parse(string $jwt): TokenInterface;
}
