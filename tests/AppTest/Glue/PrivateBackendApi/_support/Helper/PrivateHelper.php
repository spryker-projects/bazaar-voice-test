<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace AppTest\Glue\PrivateBackendApi\Helper;

use Codeception\Module;
use Spryker\Shared\Config\Config;
use Spryker\Shared\GlueBackendApiApplication\GlueBackendApiApplicationConstants;
use Spryker\Shared\ZedRequest\ZedRequestConstants;

class PrivateHelper extends Module
{
    /**
     * @param int|null $privateIdentifier
     *
     * @return string
     */
    public function buildPrivateUrl(?int $privateIdentifier = null): string
    {
        return $privateIdentifier !== null ? $this->buildBackendApiUrl('private/application/config/{id}', ['id' => $privateIdentifier]) : $this->buildBackendApiUrl('Private');
    }

    /**
     * @param string $url
     * @param array<mixed> $params
     *
     * @return string
     */
    protected function buildBackendApiUrl(string $url, array $params = []): string
    {
        $url = sprintf('%s://%s/%s', Config::get(ZedRequestConstants::ZED_API_SSL_ENABLED) ? 'https' : 'http', Config::get(GlueBackendApiApplicationConstants::GLUE_BACKEND_API_HOST), $this->formatUrl($url, $params));

        return rtrim($url, '/');
    }

    /**
     * @param string $url
     * @param array<mixed> $params
     *
     * @return string
     */
    protected function formatUrl(string $url, array $params): string
    {
        $refinedParams = [];
        foreach ($params as $key => $value) {
            $refinedParams['{' . $key . '}'] = urlencode($value);
        }

        return strtr($url, $refinedParams);
    }
}
