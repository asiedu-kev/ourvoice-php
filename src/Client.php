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
     * @var Resources\Balance
     */
    public $balance;
    
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
        $this->balance = new Resources\Balance($this->httpClient);
        $this->contacts = new Resources\Contacts($this->httpClient);
        $this->groups = new Resources\Groups($this->httpClient);
        
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
