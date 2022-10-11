<?php

namespace Ourvoice\Sdk\Resources;

use Ourvoice\Sdk\Common;
use Ourvoice\Sdk\Common\HttpClient;
use Ourvoice\Sdk\Exceptions;
use Ourvoice\Sdk\Objects;

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
        [, , $body] = $this->httpClient->performHttpRequest(
            HttpClient::REQUEST_POST,
            $this->resourceName,
            $query,
            $body
        );
        return $this->processRequest($body);
    }


    public function processRequest(?string $body)
    {
        if ($body === null) {
            throw new Exceptions\ServerException('Got an invalid JSON response from the server.');
        }

        try {
            $body = json_decode($body, null, 512, \JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new Exceptions\ServerException('Got an invalid JSON response from the server.');
        }

        if (!empty($body->errors)) {
            $responseError = new Common\ResponseError($body);
            throw new Exceptions\RequestException($responseError->getErrorString());
        }

        if ($this->responseObject) {
            return $this->responseObject->loadFromStdclass($body);
        }
        
        if (is_array($body)) {
            $parsed = [];
            foreach ($body as $b) {
                $parsed[] = $this->object->loadFromStdclass($b);
            }
            return $parsed;
        }

        return $this->object->loadFromStdclass($body);
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

            $items = $body->items;
            unset($body->items);

            $baseList = new Objects\BaseList();
            $baseList->loadFromArray($body);

            $objectName = $this->object;

            $baseList->items = [];

            if ($items === null) {
                return $baseList;
            }

            foreach ($items as $item) {
                
                $object = new $objectName($this->httpClient);

                $message = $object->loadFromArray($item);
                $baseList->items[] = $message;
            }

            return $baseList;
        }

        return $this->processRequest($body);
    }

   
    public function read($id = null)
    {
        $resourceName = $this->resourceName . (($id) ? '/' . $id : null);
        [, , $body] = $this->httpClient->performHttpRequest(HttpClient::REQUEST_GET, $resourceName);
        return $this->processRequest($body);
    }

  
    public function delete($id)
    {
        $resourceName = $this->resourceName . '/' . $id;
        [$status, , $body] = $this->httpClient->performHttpRequest(HttpClient::REQUEST_DELETE, $resourceName);

        if ($status === HttpClient::HTTP_NO_CONTENT) {
            return true;
        }

        return $this->processRequest($body);
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

        [, , $body] = $this->httpClient->performHttpRequest(
            HttpClient::REQUEST_PUT,
            $resourceName,
            false,
            $body
        );
        return $this->processRequest($body);
    }

    public function getHttpClient(): HttpClient
    {
        return $this->httpClient;
    }
}
