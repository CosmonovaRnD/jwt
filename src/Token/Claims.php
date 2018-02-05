<?php
declare(strict_types=1);

namespace CosmonovaRnD\JWT\Token;

/**
 * Class Claims
 *
 * @author  Aleksandr Besedin <bs@cosmonova.net>
 * @package CosmonovaRnD\JWT\Token
 * Cosmonova | Research & Development
 */
class Claims
{
    public const ID = 'jti';

    public const AUDIENCE = 'aud';

    public const EXPIRATION_TIME = 'exp';

    public const ISSUED_AT = 'iat';

    public const ISSUER = 'iss';

    public const NOT_BEFORE = 'nbf';

    public const SUBJECT = 'sub';

    public const USER_ID = 'uid';

    public const APP_ID = 'aid';

    public const USER = 'usr';

    public const ROLES = 'roles';
}
