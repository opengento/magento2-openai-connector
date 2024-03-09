<?php

namespace Opengento\OpenAIConnector\Model\GPT;

use Opengento\OpenAIConnector\Api\ConnectionInterface;
use OpenAI;
use Opengento\OpenAIConnector\Helper\ModuleConfig;
use OpenAI\Client as OpenAIClient;

class Connection implements ConnectionInterface
{
    /**
     * @var OpenAI
     */
    protected OpenAI $openAI;
    /**
     * @var ModuleConfig
     */
    protected ModuleConfig $moduleConfig;

    /**
     * @param OpenAI $openAI
     * @param ModuleConfig $moduleConfig
     */
    public function __construct(
        OpenAI $openAI,
        ModuleConfig $moduleConfig
    ) {
        $this->openAI = $openAI;
        $this->moduleConfig = $moduleConfig;
    }

    /**
     * @return OpenAIClient
     */
    public function initClient(): OpenAIClient
    {
        $apiKey = $this->moduleConfig->getApiKey();
        $organization = $this->moduleConfig->getOrgId();

        return $this->openAI::client($apiKey, $organization);
    }
}
