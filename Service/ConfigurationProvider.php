<?php

namespace Opengento\OpenAIConnector\Service;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class ConfigurationProvider extends AbstractHelper
{
    protected final const MODULE_ENABLE = 'openai/general/enable';
    protected final const API_KEY = 'openai/general/api_key';
    protected final const ORG_ID = 'openai/general/org_id';
    protected final const MODEL = 'openai/general/model';

    /**
     * @return bool
     */
    public function isModuleEnable(): bool
    {
        return $this->scopeConfig->isSetFlag(self::MODULE_ENABLE, ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return (string)$this->scopeConfig->getValue(self::API_KEY, ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return string
     */
    public function getOrgId(): string
    {
        return (string)$this->scopeConfig->getValue(self::ORG_ID, ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return string
     */
    public function getGPTModel(): string
    {
        return (string)$this->scopeConfig->getValue(self::MODEL, ScopeInterface::SCOPE_STORE);
    }
}
