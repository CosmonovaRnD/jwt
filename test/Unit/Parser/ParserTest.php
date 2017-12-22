<?php
declare(strict_types=1);

namespace CosmonovaRnD\JWT\Test\Unit\Parser;

use CosmonovaRnD\JWT\Parser\Parser;
use CosmonovaRnD\JWT\Token\TokenInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class ParserTest
 *
 * @author  Aleksandr Besedin <bs@cosmonova.net>
 * @package CosmonovaRnD\JWT\Test\Unit\Parser
 * Cosmonova | Research & Development
 */
class ParserTest extends TestCase
{
    public function testParse()
    {
        $jwt = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOlsidGVzdF9hdWRpZW5' .
               'jZSJdLCJqdGkiOiIxMjM0IiwiaWF0IjoiMTQ4MzIyMTYwMCIsImV4cCI6IjE4OTM' .
               '0NDg4MDAifQ.wORy2EB893op_a_b6hLHmh3UVisXA-mOotbqQEgzpPIhxBIMxgzR' .
               '7je-oKsVvZnI7JskyXhTqCsMvPYVu2cmZGVGMSKQqN7t8GgdgPrqF3i-OXkQIK7G' .
               '4Qs6-RJ1iUQ61Chk_0tneJSz7cBvLnjiPm2HSW-SUmB41U3_WzBqSrZcVKvv0EjA' .
               '1f6bDb0v3R1u3Uqh-Gs1gmE3gf_bOQifcC-zJ3wr-l4YsBfPcHARrXfJ5Xj5nkDF' .
               'but8eTLn5BvnqB65sp9lB1Yltn16mHe84cmhx6cLBOmsF1XcQcd6Wz7UQgsTcbiI' .
               'azJ7ZbeNp1nFuXr15P-3GjtqureBj3kx0A';

        $parser = new Parser();
        
        $this->assertInstanceOf(TokenInterface::class, $parser->parse($jwt));
    }
}
