<?php

namespace Opengento\OpenAIConnector\Model\GPT;

use OpenAI\Client as OpenAIClient;
use Opengento\OpenAIConnector\Api\ConnectionInterface as GPTConnection;
use Opengento\OpenAIConnector\Api\GPTCompletionsInterface;
use Opengento\OpenAIConnector\Model\Exception\OpenAICompletionException;
use Opengento\OpenAIConnector\Service\ConfigurationProvider;

class GPTCompletions implements GPTCompletionsInterface
{
    /**
     * @var OpenAIClient|null
     */
    protected ?OpenAIClient $openAIClient = null;

    /**
     * @param ConfigurationProvider $configurationProvider
     * @param GPTConnection $connection
     */
    public function __construct(
        protected ConfigurationProvider $configurationProvider,
        protected GPTConnection $connection,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function getGPTCompletions(
        string $prompt,
        string $assistantContext = self::DEFAULT_CONTEXT,
        float  $temperature = self::DEFAULT_TEMPERATURE,
    ): string
    {
        if (empty($this->openAIClient)) {
            $this->openAIClient = $this->connection->initClient();
        }

        try {
            $response = $this->openAIClient
                ->chat()
                ->create($this->getOpenAIParams(
                    $prompt,
                    $assistantContext,
                    $temperature
                ))->toArray();

            return trim($response['choices'][0]['message']['content']);
        } catch (\Exception $e) {
            throw new OpenAICompletionException(__('Unable to reach AI: %1', $e->getMessage()));
        }
    }

    /**
     * @param string $prompt
     * @param string $assistantContext
     * @param float $temperature
     * @return array
     */
    protected function getOpenAIParams(
        string $prompt,
        string $assistantContext,
        float  $temperature,
    ): array
    {
        return [
            'model' => $this->configurationProvider->getGPTModel(),
            'messages' => [
                ['role' => 'system', 'content' => $this->resolveContextValue($assistantContext)],
                ['role' => 'user', 'content' => $prompt],
            ],
            'temperature' => $this->resolveTemperatureValue($temperature),
            'max_tokens' => 1000
        ];
    }

    /**
     * @param string $context
     * @return string
     */
    protected function resolveContextValue(string $context): string
    {
        if ($context === self::DEFAULT_CONTEXT) {
            return $this->configurationProvider->getAssistantContext();
        }

        return $context;
    }

    /**
     * @param float $temperature
     * @return float
     */
    protected function resolveTemperatureValue(float $temperature): float
    {
        if ($temperature === self::DEFAULT_TEMPERATURE) {
            return $this->configurationProvider->getTemperature();
        }

        return $temperature;
    }
}
