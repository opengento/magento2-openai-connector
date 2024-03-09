<?php

declare(strict_types=1);

namespace Opengento\OpenAIConnector\Api\Service\Security;

interface SecureResponseValidatorInterface
{
    public final const UNSECURED_WORDS = ['INSERT', 'DELETE', 'CREATE', 'UPDATE', 'ALTER', 'DROP'];

    /**
     * @param string $response
     * @return bool
     */
    public function isResponseSafe(string $response): bool;
}
