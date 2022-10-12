<?php

namespace Tests\Integration\Campaign;

use Ourvoice\Sdk\Exceptions\ServerException;
use  Ourvoice\Sdk\Common\HttpClient;
use Tests\Integration\BaseTest;
use  Ourvoice\Sdk\Objects\Campaign;
use  Ourvoice\Sdk\Objects\Account;
use  Ourvoice\Sdk\Objects\Group;
use  Ourvoice\Sdk\Objects\Message;

class CampaignTest extends BaseTest
{

    public function testCreateCampaign(): void
    {
        $account = new Account();
        $group = new Group();
        $message = new Message();
        $campaign = new Campaign();
        $campaign->type = "sms";
        $campaign->repeat = "never";
        $campaign->start_date = "2000-01-01 00:00:00";
        $campaign->end_date = "2004-10-23 07:23:47";
        $campaign->status = "seding";
        $campaign->account_id = $account->id;
        $campaign->group_id = $group->id;
        $campaign->message_id = $message->id;

        $this->mockClient->expects(self::once())->method('performHttpRequest')->willReturn([
            200,
            '',
            '{
            "type": "sms",
            "repeat":"never",
            "start_date":"2000-01-01 00:00:00",
            "end_date": "2004-10-23 07:23:47",
            "status":"seding",
            "account_id": "$account->id",
            "group_id": "$group->id",
            "message_id": "$message->id",
            "createdDatetime": "2016-04-29T09:42:26+00:00",
            "updatedDatetime": "2016-04-29T09:42:26+00:00"
            
        }',
        ]);
        $this->client->campaigns->create($campaign);
    }
        
        


    public function testListCampaign(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with("GET", 'campaigns', null, null);
        $this->client->campaigns->read();
    }

    public function testViewCampaign(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "GET",
            'campaigns/campaign_id',
            null,
            null
        );
        $this->client->campaigns->read("campaign_id");
    }

    
    public function testUpdateCampaign(): void
    {
        $this->mockClient
            ->expects($this->exactly(1))->method('performHttpRequest')
            ->withConsecutive(
                ['PUT', 'campaigns/campaign_id', null, '{"type":"voice"}'],
               
            )
            ->willReturn([200, '', '{}']);

        $campaign = new Campaign();
        $campaign->type = "voice" ;
        $this->client->campaigns->update($campaign, 'campaign_id');

    }

    public function testDeleteCampaign(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "DELETE",
            'campaigns/campaign_id',
            null,
            null
        );
        $this->client->campaigns->delete("campaign_id");
    }
}
