<?php

namespace Ourvoice\Resources;

use Ourvoice\Common;
use Ourvoice\Common\HttpClient;
use Ourvoice\Objects;

/**
 * Class Campaign
 *
 * @package Ourvoice\Sdk\Resources
 */
class Campaigns extends Base
{
    private $voice;
    private $message;
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Campaign();
        $this->setResourceName('campaigns');

        parent::__construct($httpClient);
    }

    public function deleteManyCampaigns(array $campaigns_ids)
    {
        if(empty($campaigns_ids)) {
            throw new InvalidArgumentException('No group id provided.');
        }

        $campaigns = json_encode($campaigns_ids, \JSON_THROW_ON_ERROR);

        [$responseStatus, , $responseBody] = $this->httpClient->performHttpRequest(
            Common\HttpClient::REQUEST_DELETE,
            $this->resourceName,
            false,
            $campaigns
        );
        if ($responseStatus === HttpClient::HTTP_NO_CONTENT) {
            return true;
        }
    }

    public function getCampaignVoice(string $campaign_id) {
        $resourceName = $this->resourceName . ('/'.$campaign_id .'/voice/');

        [$responseStatus, , $responseBody] = $this->httpClient->performHttpRequest(
            Common\HttpClient::REQUEST_GET,
            $resourceName,
            false
        );
        if ($responseStatus === HttpClient::HTTP_SUCCESS) {
            $this->voice->setResponseObject($responseBody);
        }
    }
}
