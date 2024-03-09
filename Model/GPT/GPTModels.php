<?php

namespace Opengento\OpenAIConnector\Model\GPT;

use Exception;
use Magento\Framework\Message\Manager as MessageManager;
use OpenAI\Client as OpenAIClient;
use Opengento\OpenAIConnector\Api\ConnectionInterface as GPTConnection;
use Opengento\OpenAIConnector\Api\GPTModelsInterface;
use Opengento\OpenAIConnector\Service\ConfigurationProvider;

class GPTModels implements GPTModelsInterface
{
    /**
     * @var OpenAIClient|null
     */
    protected ?OpenAIClient $openAIClient = null;

    /**
     * @param ConfigurationProvider $configurationProvider
     * @param Connection $connection
     * @param MessageManager $messageManager
     */
    public function __construct(
        protected ConfigurationProvider $configurationProvider,
        protected GPTConnection $connection,
        protected MessageManager $messageManager
    ) {
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getGPTModels(): array
    {
        try {
            if (empty($this->openAIClient)) {
                $this->openAIClient = $this->connection->initClient();
            }

            $models = $this->openAIClient->models()->list()->toArray();

            return $models['data'];
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());

            return [];
        }
    }
}
