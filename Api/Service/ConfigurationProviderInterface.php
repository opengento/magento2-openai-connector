<?php

namespace Opengento\OpenAIConnector\Api\Service;

interface ConfigurationProviderInterface
{
    final const MODULE_ENABLE = 'openai/general/enable';
    final const API_KEY = 'openai/general/api_key';
    final const ORG_ID = 'openai/general/org_id';
    final const MODEL = 'openai/general/model';
    final const ASSISTANT_CONTEXT = 'openai/general/assistant_context';
    final const TEMPERATURE = 'openai/general/temperature';

    /**
     * @return bool
     */
    public function isModuleEnable(): bool;

    /**
     * @return string
     */
    public function getApiKey(): string;

    /**
     * @return string
     */
    public function getOrgId(): string;

    /**
     * @return string
     */
    public function getGPTModel(): string;

    /**
     * @return string
     */
    public function getAssistantContext(): string;

    /**
     * @return float
     */
    public function getTemperature(): float;
}
