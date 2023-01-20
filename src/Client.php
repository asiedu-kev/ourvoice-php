<?php

namespace Ourvoice\Sdk;

use Ourvoice\Sdk\Common\HttpClient;

/**
 * Class Client
 *
 * @package Ourvoice\Sdk
 */
class Client
{
    public const ENDPOINT = 'https://staging.getourvoice.com/api/v1/';
    
    const CLIENT_VERSION = '3.1.2';

    
    /**
     * @var Resources\Contacts
     */
    public $contacts;
    /**
     * @var Resources\Groups
     */
    public $groups;
     /**
     * @var Resources\Account
     */
    public $accounts;

    /**
     * @var Resources\Role
     */
    public $roles;

    /**
     * @var Resources\Action
     */
    public $actions;
    
    /**
     * @var Resources\Condition
     */
    public $conditions;

    /**
     * @var Resources\ActionCondition
     */
    public $action_conditions;

    /**
     * @var Resources\ApiKey
     */
    public $apikeys;
    
    /**
     * @var Resources\Campaign
     */
    public $campaigns;

    /**
     * @var Resources\Invitation
     */
    public $invitations;

    /**
     * @var Resources\Media
     */
    public $medias;

    /**
     * @var Resources\Message
     */
    public $messages;


      /**
     * @var Resources\User
     */
    public $users;
    
    protected $endpoint = self::ENDPOINT;
    /**
     * @var Common\HttpClient
     */
    protected $httpClient;

    

    public function __construct(?string $accessKey = null, Common\HttpClient $httpClient = null, array $config = [])
    {
        if ($httpClient === null) {
           
            $this->httpClient = new Common\HttpClient(self::ENDPOINT);
            
        } else {
            
            $this->httpClient = $httpClient;
           
        }

        $this->httpClient->addUserAgentString('Ourvoice\Sdk/ApiClient/' . self::CLIENT_VERSION);
        $this->httpClient->addUserAgentString($this->getPhpVersion());

        if ($accessKey !== null) {
            $this->setAccessKey($accessKey);
        }
        $this->accounts = new Resources\Account($this->httpClient);
        $this->contacts = new Resources\Contacts($this->httpClient);
        $this->groups = new Resources\Groups($this->httpClient);
        $this->roles = new Resources\Role($this->httpClient);
        $this->actions = new Resources\Action($this->httpClient);
        $this->conditions = new Resources\Condition($this->httpClient);
        $this->action_conditions = new Resources\ActionCondition($this->httpClient);
        $this->apikeys = new Resources\ApiKey($this->httpClient);
        $this->campaigns = new Resources\Campaign($this->httpClient);
        $this->invitations = new Resources\Invitation($this->httpClient);
        $this->medias = new Resources\Media($this->httpClient);
        $this->messages = new Resources\Message($this->httpClient);
        $this->users = new Resources\User($this->httpClient);
    }

    private function getPhpVersion(): string
    {
        if (!\defined('PHP_VERSION_ID')) {
            $version = array_map('intval', explode('.', \PHP_VERSION));
            \define('PHP_VERSION_ID', $version[0] * 10000 + $version[1] * 100 + $version[2]);
        }

        return 'PHP/' . \PHP_VERSION_ID;
    }

    /**
     * @param mixed $accessKey
     */
    public function setAccessKey($accessKey): void
    {
        $authentication = new Common\Authentication($accessKey);

        
        $this->httpClient->setAuthentication($authentication);
       
    }
}
