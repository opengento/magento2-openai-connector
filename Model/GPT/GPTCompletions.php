<?php

namespace Opengento\OpenAIConnector\Model\GPT;

use Exception;
use OpenAI\Client as OpenAIClient;
use Opengento\OpenAIConnector\Api\ConnectionInterface as GPTConnection;
use Opengento\OpenAIConnector\Api\GPTCompletionsInterface;
use Opengento\OpenAIConnector\Service\ConfigurationProvider;

class GPTCompletions implements GPTCompletionsInterface
{
    /**
     * @var ConfigurationProvider
     */
    protected ConfigurationProvider $configurationProvider;
    /**
     * @var GPTConnection
     */
    protected GPTConnection $connection;
    /**
     * @var OpenAIClient|null
     */
    protected ?OpenAIClient $openAIClient = null;

    /**
     * @param ConfigurationProvider $configurationProvider
     * @param GPTConnection $connection
     */
    public function __construct(
        ConfigurationProvider $configurationProvider,
        GPTConnection $connection
    ) {
        $this->configurationProvider = $configurationProvider;
        $this->connection = $connection;
    }

    /**
     * @param string $prompt
     * @return string
     * @throws Exception
     */
    public function getGPTCompletions(
        string $prompt,
        string $assistantContext = '',
        float  $temperature = self::DEFAULT_TEMPERATURE,
    ): string {
        if (empty($this->openAIClient)) {
            $this->openAIClient = $this->connection->initClient();
        }

        $assistantContext = $assistantContext ?: $this->configurationProvider->getAssistantContext();
        $temperature = $temperature === self::DEFAULT_TEMPERATURE ? $this->configurationProvider->getTemperature() : $temperature;

        try {
            $result = $this->openAIClient->completions()->create([
                'model' => $this->configurationProvider->getGPTModel(),
                'messages' => [
                    ['role' => 'system', 'content' => $assistantContext],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'temperature' => $temperature
            ]);

            return trim($result['choices'][0]['text']);
        } catch (Exception $e) {
            $result = $this->openAIClient->chat()->create([
                'model' => $this->configurationProvider->getGPTModel(),
                'messages' => [
                    ['role' => 'system', 'content' => $assistantContext],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'temperature' => $temperature
            ])->toArray();

            return trim($result['choices'][0]['message']['content']);
        }
    }
}
