<?php

namespace Opengento\OpenAIConnector\Model\Config\GPT;

use Exception;
use Magento\Framework\Data\OptionSourceInterface;
use Opengento\OpenAIConnector\Api\GPTModelsInterface;
use Opengento\OpenAIConnector\Service\ConfigurationProvider;

class Models implements OptionSourceInterface
{
    /**
     * @param ConfigurationProvider $configurationProvider
     * @param GPTModelsInterface $GPTModels
     */
    public function __construct(
        protected ConfigurationProvider       $configurationProvider,
        protected GPTModelsInterface $GPTModels
    ) {
    }

    /**
     * @return array
     * @throws Exception
     */
    public function toOptionArray(): array
    {
        if (empty($this->configurationProvider->getApiKey()) || empty($this->configurationProvider->getOrgId())) {
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
