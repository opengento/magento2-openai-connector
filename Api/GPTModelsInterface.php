<?php

namespace Opengento\OpenAIConnector\Api;

use Exception;

interface GPTModelsInterface
{
    /**
     * @return array
     * @throws Exception
     */
    public function getGPTModels(): array;
}
