<?php

namespace Ourvoice\Resources;

use InvalidArgumentException;
use Ourvoice\Common;
use Ourvoice\Objects;

/**
 * Class Account
 *
 * @package Ourvoice\Sdk\Resources
 */
class Flows extends Base
{
    private $flowsWithLogsObject;

    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Flow();
        $this->setResourceName('flows');

        parent::__construct($httpClient);
    }

    public function getFlowWithLogs(?array $parameters = [])
    {
        $this->flowsWithLogsObject->setResourceName('flow-logs');
        return $this->flowsWithLogsObject->getList($parameters);
    }

    public function startFlow(?string $id = null)
    {
        if ($id === null) {
            throw new InvalidArgumentException('No flow id provided.');
        }
        $resourceName = $this->resourceName . ($id ? '/' . $id . '/start' : null);
        [$responseStatus, , $responseBody] = $this->httpClient->performHttpRequest(
            Common\HttpClient::REQUEST_POST,
            $resourceName,
            false,
        );
        if ($responseStatus !== Common\HttpClient::HTTP_SUCCESS) {
            return json_decode($responseBody, null, 512, \JSON_THROW_ON_ERROR);
        }
        return $responseBody;
    }

    public function getFlowStats(?string $id = null)
    {
        if ($id === null) {
            throw new InvalidArgumentException('No flow id provided.');
        }
        $resourceName = "flow-reports/".$id;
        [$responseStatus, , $responseBody] = $this->httpClient->performHttpRequest(
            Common\HttpClient::REQUEST_GET,
            $resourceName,
            false,
        );
        if ($responseStatus !== Common\HttpClient::HTTP_SUCCESS) {
            return json_decode($responseBody, null, 512, \JSON_THROW_ON_ERROR);
        }
        return $responseBody;
    }
}
