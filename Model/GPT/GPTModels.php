<?php

namespace Opengento\OpenAIConnector\Model\GPT;

use Opengento\OpenAIConnector\Api\GPTModelsInterface;
use Opengento\OpenAIConnector\Helper\ModuleConfig;
use Opengento\OpenAIConnector\Api\ConnectionInterface as GPTConnection;
use OpenAI\Client as OpenAIClient;
use Exception;

class GPTModels implements GPTModelsInterface
{
    /**
     * @var ModuleConfig
     */
    protected ModuleConfig $moduleConfig;
    /**
     * @var Connection
     */
    protected GPTConnection $connection;
    /**
     * @var OpenAIClient|null
     */
    protected ?OpenAIClient $openAIClient = null;

    /**
     * @param ModuleConfig $moduleConfig
     * @param Connection $connection
     */
    public function __construct(
        ModuleConfig $moduleConfig,
        GPTConnection $connection
    ) {
        $this->moduleConfig = $moduleConfig;
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
