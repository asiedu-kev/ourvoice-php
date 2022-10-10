<?php

namespace Tests\Integration\Groups;


use  Ourvoice\Sdk\Exceptions\ServerException;
use  Ourvoice\Sdk\Objects\Group;
use Tests\Integration\BaseTest;

class GroupTest extends BaseTest
{
   

    public function testListGroups(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects($this->once())->method('performHttpRequest')->with(
            "GET",
            'groups',
            ['offset' => 100, 'limit' => 30],
            null
        );
        $this->client->groups->getList(['offset' => 100, 'limit' => 30]);
    }

    public function testViewGroup(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects($this->once())->method('performHttpRequest')->with(
            "GET",
            'groups/group_id',
            null,
            null
        );
        $this->client->groups->read("group_id");
    }

    public function testDeleteGroup(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects($this->once())->method('performHttpRequest')->with(
            "DELETE",
            'groups/group_id',
            null,
            null
        );
        $this->client->groups->delete("group_id");
    }
}
