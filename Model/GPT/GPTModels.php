<?php

namespace Opengento\OpenAIConnector\Model\GPT;

use Exception;
use OpenAI\Client as OpenAIClient;
use Opengento\OpenAIConnector\Api\ConnectionInterface as GPTConnection;
use Opengento\OpenAIConnector\Api\GPTModelsInterface;
use Opengento\OpenAIConnector\Service\ConfigurationProvider;

class GPTModels implements GPTModelsInterface
{
    /**
     * @var ConfigurationProvider
     */
    protected ConfigurationProvider $configurationProvider;
    /**
     * @var Connection
     */
    protected GPTConnection $connection;
    /**
     * @var OpenAIClient|null
     */
    protected ?OpenAIClient $openAIClient = null;

    /**
     * @param ConfigurationProvider $configurationProvider
     * @param Connection $connection
     */
    public function __construct(
        ConfigurationProvider $configurationProvider,
        GPTConnection $connection
    ) {
        $this->configurationProvider = $configurationProvider;
        $this->connection = $connection;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getGPTModels(): array
    {
        if (empty($this->openAIClient)) {
            $this->openAIClient = $this->connection->initClient();
        }

        $models = $this->openAIClient->models()->list()->toArray();

        return $models['data'];
    }
}
