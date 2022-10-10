<?php

namespace Tests\Integration\Campaign;

use Ourvoice\Sdk\Exceptions\ServerException;
use  Ourvoice\Sdk\Common\HttpClient;
use Tests\Integration\BaseTest;

class CampaignTest extends BaseTest
{
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
