<?php

namespace Opengento\OpenAIConnector\Model\Config\GPT;

use Magento\Framework\Data\OptionSourceInterface;
use Opengento\OpenAIConnector\Helper\ModuleConfig;
use Opengento\OpenAIConnector\Api\GPTModelsInterface;
use Exception;

class Models implements OptionSourceInterface
{
    /**
     * @param ModuleConfig $moduleConfig
     * @param GPTModelsInterface $GPTModels
     */
    public function __construct(
        protected ModuleConfig       $moduleConfig,
        protected GPTModelsInterface $GPTModels
    ) {
    }

    /**
     * @return array
     * @throws Exception
     */
    public function toOptionArray(): array
    {
        if (empty($this->moduleConfig->getApiKey()) || empty($this->moduleConfig->getOrgId())) {
            return [];
        }

        $return = [];

        foreach ($this->GPTModels->getGPTModels() as $model) {
            $return[] = [
                'value' => $model['id'],
                'label' => $model['id']
            ];
        }

        return $return;
    }
}
