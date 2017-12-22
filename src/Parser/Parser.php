<?php
declare(strict_types=1);

namespace CosmonovaRnD\JWT\Parser;

use CosmonovaRnD\JWT\Token\Token;
use CosmonovaRnD\JWT\Token\TokenInterface;
use Lcobucci\Jose\Parsing\Parser as Decoder;
use Lcobucci\JWT\Token\Parser as JwtParser;

/**
 * Class Parser
 *
 * @author  Aleksandr Besedin <bs@cosmonova.net>
 * @package CosmonovaRnD\JWT\Parser
 * Cosmonova | Research & Development
 */
final class Parser implements ParserInterface
{
    private $parser;

    public function __construct()
    {
        $this->parser = new JwtParser(new Decoder());
    }

    /**
     * @param string $jwt
     *
     * @return \CosmonovaRnD\JWT\Token\TokenInterface
     */
    public function parse(string $jwt): TokenInterface
    {
        /** @var \Lcobucci\JWT\Token\Plain $token */
        $token = $this->parser->parse($jwt);

        return new Token($token);
    }
}
