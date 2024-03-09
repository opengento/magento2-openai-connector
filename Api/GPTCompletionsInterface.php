<?php

namespace Opengento\OpenAIConnector\Api;

use Opengento\OpenAIConnector\Model\Exception\OpenAICompletionException;

interface GPTCompletionsInterface
{
    public final const DEFAULT_CONTEXT = '';
    public final const DEFAULT_TEMPERATURE = 1;

    /**
     * @param string $prompt
     * @param string $assistantContext
     * @param float $temperature
     * @return string
     * @throws OpenAICompletionException
     */
    public function getGPTCompletions(
        string $prompt,
        string $assistantContext = self::DEFAULT_CONTEXT,
        float  $temperature = self::DEFAULT_TEMPERATURE,
    ): string;
}
