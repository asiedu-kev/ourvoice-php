<?php

namespace Ourvoice\Resources;

use InvalidArgumentException;
use Ourvoice\Common;
use Ourvoice\Common\HttpClient;
use Ourvoice\Objects;

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

    public function removeContactFromGroup(?string $group_id, ?string $contact_id)
    {
        if ($contact_id === null) {
            throw new InvalidArgumentException('No contact id provided.');
        }
        if ($group_id == null) {
            throw new InvalidArgumentException('No group id provided.');
        }
        $resourceName = $this->resourceName . ('/' . $group_id . '/contacts/' . $contact_id);
        [$responseStatus, , $responseBody] = $this->httpClient->performHttpRequest(
            Common\HttpClient::REQUEST_DELETE,
            $resourceName,
            false,
        );
        if ($responseStatus === HttpClient::HTTP_NO_CONTENT) {
            return true;
        }
    }

    public function removeContactsFromGroup(?string $group_id, array $contact_ids)
    {
        if($group_id == null) {
            throw new InvalidArgumentException('No group id provided.');
        }
        $contacts = json_encode($contact_ids, \JSON_THROW_ON_ERROR);
        $resourceName = $this->resourceName . ('/'.$group_id .'/contacts/');
        [$responseStatus, , $responseBody] = $this->httpClient->performHttpRequest(
            Common\HttpClient::REQUEST_DELETE,
            $resourceName,
            false,
            $contacts
        );
        if ($responseStatus === HttpClient::HTTP_NO_CONTENT) {
            return true;
        }
    }

}
