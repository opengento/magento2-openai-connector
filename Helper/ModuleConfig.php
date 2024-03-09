<?php

namespace Opengento\OpenAIConnector\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class ModuleConfig extends AbstractHelper
{
    protected final const CORE_PATH = 'openai/general/';
    public final const MODULE_ENABLE = self::CORE_PATH . 'enable';
    public final const API_KEY = self::CORE_PATH . 'api_key';
    public final const ORG_ID = self::CORE_PATH . 'org_id';
    public final const MODEL = self::CORE_PATH . 'model';

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
