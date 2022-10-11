<?php

namespace Ourvoice\Sdk\Resources;

use InvalidArgumentException;
use Ourvoice\Sdk\Common;
use Ourvoice\Sdk\Exceptions;
use Ourvoice\Sdk\Objects;

/**
 * Class Groups
 *
 * @package Ourvoice\Sdk\Resources
 */
class Groups extends Base
{
    /**
     * @var Contacts
     */
    private $contactsObject;

    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Group();
        $this->setResourceName('groups');

        $this->contactsObject = new Contacts($httpClient);

        parent::__construct($httpClient);
    }



    public function getContacts(?string $id = null, ?array $parameters = [])
    {
        if ($id === null) {
            throw new InvalidArgumentException('No group id provided.');
        }

        $this->contactsObject->setResourceName($this->resourceName . '/' . $id . '/contacts');
        return $this->contactsObject->getList($parameters);
    }

    public function addContacts(array $contacts, ?string $id = null)
    {
        if (!\is_array($contacts)) {
            throw new  InvalidArgumentException('No array with contacts provided.');
        }
        if ($id === null) {
            throw new InvalidArgumentException('No group id provided.');
        }

        $resourceName = $this->resourceName . ($id ? '/' . $id . '/contacts' : null);
        $contacts = json_encode($contacts, \JSON_THROW_ON_ERROR);
        [$responseStatus, , $responseBody] = $this->httpClient->performHttpRequest(
            Common\HttpClient::REQUEST_PUT,
            $resourceName,
            false,
            $contacts
        );
        if ($responseStatus !== Common\HttpClient::HTTP_NO_CONTENT) {
            return json_decode($responseBody, null, 512, \JSON_THROW_ON_ERROR);
        }
    }

}
