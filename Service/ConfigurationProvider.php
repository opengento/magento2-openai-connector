<?php

namespace Opengento\OpenAIConnector\Service;

use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Opengento\OpenAIConnector\Api\Service\ConfigurationProviderInterface;

class ConfigurationProvider implements ConfigurationProviderInterface
{
    public function __construct(
        protected ScopeConfigInterface $scopeConfig,
    ) {
    }

    /**
     * @return bool
     */
    public function isModuleEnable(): bool
    {
        return $this->scopeConfig->isSetFlag(static::MODULE_ENABLE, ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return (string)$this->scopeConfig->getValue(static::API_KEY, ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return string
     */
    public function getOrgId(): string
    {
        return (string)$this->scopeConfig->getValue(static::ORG_ID, ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return string
     */
    public function getGPTModel(): string
    {
        return (string)$this->scopeConfig->getValue(static::MODEL, ScopeInterface::SCOPE_STORE);
    }

    public function getAssistantContext(): string
    {
        return (string)$this->scopeConfig->getValue(static::ASSISTANT_CONTEXT, ScopeInterface::SCOPE_STORE);
    }

    public function getTemperature(): float
    {
        return (float)$this->scopeConfig->getValue(static::TEMPERATURE, ScopeInterface::SCOPE_STORE);
    }
}
