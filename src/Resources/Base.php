<?php

namespace Ourvoice\Resources;

use Ourvoice\Common\HttpClient;
use Ourvoice\Common;
use Ourvoice\Exceptions;
use Ourvoice\Objects;

/**
 * Class Base
 *
 * @package Ourvoice\Sdk\Resources
 */
class Base
{
    /**
     * @var HttpClient
     */
    protected $httpClient;


    protected $resourceName;


    protected $object;


    protected $responseObject;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getResourceName(): string
    {
        return $this->resourceName;
    }


    public function setResourceName($resourceName): void
    {
        $this->resourceName = $resourceName;
    }


    public function getObject()
    {
        return $this->object;
    }

    public function setObject($object): void
    {
        $this->object = $object;
    }

    public function getResponseObject()
    {
        return $this->responseObject;
    }

    public function setResponseObject($responseObject): void
    {
        $this->responseObject = $responseObject;
    }


    public function create($object, ?array $query = null)
    {
        $body = json_encode($object, \JSON_THROW_ON_ERROR);
        [$status, , $body] = $this->httpClient->performHttpRequest(
            HttpClient::REQUEST_POST,
            $this->resourceName,
            $query,
            $body
        );
        return $this->processRequest($status,$body);
    }


    public function processRequest(?string $status,?string $body)
    {
        if ($body === null) {
            throw new Exceptions\ServerException('Got an invalid JSON response from the server.');
        }
        else {
            try {
                $body = json_decode($body, null, 512, \JSON_THROW_ON_ERROR);
                var_dump($status);
                switch ($status){
                    case '201':
                    case '200':
                    case '204':
                        if ($this->responseObject) {
                            return $this->responseObject->loadFromStdclass($body);
                        }

                        if (is_array($body)) {
                            $parsed = [];
                            foreach ($body as $b) {
                                $parsed[] = $this->object->loadFromStdclass($body);
                            }
                            return $parsed;
                        }

                        return $this->object->loadFromStdclass($body);
                        break;
                    default:
                        $responseError = new Common\ResponseError($status,$body->data);
                        throw new Exceptions\RequestException($responseError->getErrorString());
                        break;
                }
            } catch (\JsonException $e) {
                throw new Exceptions\ServerException('Got an invalid JSON response from the server.');
            }
        }
    }


    public function getList(?array $parameters = [])
    {
        [$status, , $body] = $this->httpClient->performHttpRequest(
            HttpClient::REQUEST_GET,
            $this->resourceName,
            $parameters
        );

        if ($status === 200) {
            $body = json_decode($body, null, 512, \JSON_THROW_ON_ERROR);

            $data = $body->data;
            unset($body->data);

            $baseList = new Objects\BaseList();
            $baseList->loadFromArray($body);

            $objectName = $this->object;

            $baseList->data = [];

            if ($data === null) {
                return $baseList;
            }

            foreach ($data as $item) {

                $object = new $objectName($this->httpClient);

                $message = $object->loadFromArray($item);
                $baseList->data[] = $message;
            }

            return $baseList;
        }

        return $this->processRequest($status,$body);
    }


    public function read($id = null)
    {
        $resourceName = $this->resourceName . (($id) ? '/' . $id : null);
        [$status, , $body] = $this->httpClient->performHttpRequest(HttpClient::REQUEST_GET, $resourceName);
        return $this->processRequest($status,$body);
    }


    public function delete($id)
    {
        $resourceName = $this->resourceName . '/' . $id;
        [$status, , $body] = $this->httpClient->performHttpRequest(HttpClient::REQUEST_DELETE, $resourceName);

        if ($status === HttpClient::HTTP_NO_CONTENT) {
            return true;
        }

        return $this->processRequest($status,$body);
    }


    public function update($object, $id)
    {
        $objVars = get_object_vars($object);
        $body = [];
        foreach ($objVars as $key => $value) {
            if ($value !== null) {
                $body[$key] = $value;
            }
        }

        $resourceName = $this->resourceName . ($id ? '/' . $id : null);
        $body = json_encode($body, \JSON_THROW_ON_ERROR);

        [$status, , $body] = $this->httpClient->performHttpRequest(
            HttpClient::REQUEST_PUT,
            $resourceName,
            false,
            $body
        );
        return $this->processRequest($status,$body);
    }

    public function getHttpClient(): HttpClient
    {
        return $this->httpClient;
    }
}
