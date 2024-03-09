<?php

namespace Opengento\OpenAIConnector\Api;

use Opengento\OpenAIConnector\Model\Exception\OpenAICompletionException;

interface GPTCompletionsInterface
{
    public final const DEFAULT_CONTEXT     = '';
    public final const DEFAULT_TEMPERATURE = 1.0;

    /**
     * @throws OpenAICompletionException
     */
    public function getGPTCompletions(
        string $prompt,
        string $assistantContext = self::DEFAULT_CONTEXT,
        float  $temperature = self::DEFAULT_TEMPERATURE,
    ): string;
}
