<?php

declare(strict_types=1);

namespace Opengento\OpenAIConnector\Service\Security;

use Opengento\OpenAIConnector\Api\Service\Security\SecureResponseValidatorInterface;

class SecureResponseValidator implements SecureResponseValidatorInterface
{
    /**
     * @inheritDoc
     */
    public function isResponseSafe(string $response): bool
    {
        foreach (self::UNSECURED_WORDS as $unsecureWord) {
            if (\str_contains($response, $unsecureWord)) {
                return false;
            }
        }

        return true;
    }
}
