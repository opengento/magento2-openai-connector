<?php

namespace Opengento\OpenAIConnector\Api;

use \Exception;

interface GPTCompletionsInterface
{
    public const DEFAULT_TEMPERATURE = 1;

    /**
     * @param string $prompt
     * @return string
     * @throws Exception
     */
    public function getGPTCompletions(
        string $prompt,
        string $assistantContext = '',
        float  $temperature = 1,
    ): string;
}
