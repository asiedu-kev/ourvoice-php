<?php

namespace Ourvoice\Sdk\Resources;

use InvalidArgumentException;
use Ourvoice\Sdk\Common;
use Ourvoice\Sdk\Exceptions;
use Ourvoice\Sdk\Objects;
use Ourvoice\Sdk\Resources\Messages;

/**
 * Class Contacts
 *
 * @package Ourvoice\Sdk\Resources
 */
class Contacts extends Base
{
    /**
     * @var Messages
     */
    private $messagesObject;

    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Contact();
        $this->setResourceName('contacts');

        parent::__construct($httpClient);
    }

    /**
     * @param mixed $object
     * @param mixed $id
     *
     * @return Objects\Balance|Objects\Conversation\Conversation|Objects\Hlr|Objects\Lookup|Objects\Message|Objects\Verify|Objects\VoiceMessage|null ->object
     *
     * @throws \JsonException
     * @throws Exceptions\AuthenticateException
     * @throws Exceptions\HttpException
     * @throws Exceptions\RequestException
     * @throws Exceptions\ServerException
     *
     * @internal param array $parameters
     */
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
            Common\HttpClient::REQUEST_PATCH,
            $resourceName,
            false,
            $body
        );
        return $this->processRequest($body);
    }


   
}
