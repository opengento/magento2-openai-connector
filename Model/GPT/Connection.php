<?php

namespace Opengento\OpenAIConnector\Model\GPT;

use OpenAI;
use OpenAI\Client as OpenAIClient;
use Opengento\OpenAIConnector\Api\ConnectionInterface;
use Opengento\OpenAIConnector\Service\ConfigurationProvider;

class Connection implements ConnectionInterface
{
    /**
     * @var OpenAI
     */
    protected OpenAI $openAI;
    /**
     * @var ConfigurationProvider
     */
    protected ConfigurationProvider $configurationProvider;

    /**
     * @param OpenAI $openAI
     * @param ConfigurationProvider $configurationProvider
     */
    public function __construct(
        OpenAI $openAI,
        ConfigurationProvider $configurationProvider
    ) {
        $this->openAI = $openAI;
        $this->configurationProvider = $configurationProvider;
    }

    /**
     * @return OpenAIClient
     */
    public function initClient(): OpenAIClient
    {
        $apiKey = $this->configurationProvider->getApiKey();
        $organization = $this->configurationProvider->getOrgId();

        return $this->openAI::client($apiKey, $organization);
    }
}
