<?php

namespace Tests\Integration\Groups;


use  Ourvoice\Exceptions\ServerException;
use  Ourvoice\Objects\Group;
use Tests\Integration\BaseTest;
use  Ourvoice\Objects\Account;

class GroupTest extends BaseTest
{
    public function testCreateGroup(): void
    {
       
        $account = new Account();
        $group = new Group();
        $group->name = "John";
        $group->description = "Johnhg";
        $group->account_id = $account->id;
        

        $this->mockClient->expects(self::once())->method('performHttpRequest')->willReturn([
            200,
            '',
            '{
            "name": "John",
            "description": "Johnhg",
            "account_id": "$account->id",
            "createdDatetime": "2016-04-29T09:42:26+00:00",
            "updatedDatetime": "2016-04-29T09:42:26+00:00"
        }',
        ]);
       
        $this->client->groups->create($group);
    }

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
    public function testUpdateGroup(): void
    {
        $this->mockClient
            ->expects($this->exactly(1))->method('performHttpRequest')
            ->withConsecutive(
                ['PUT', 'groups/group_id', null, '{"name":"gagle"}'],
               
            )
            ->willReturn([200, '', '{}']);

        $group = new Group();
        $group->name = "gagle" ;
        $this->client->groups->update($group, 'group_id');

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
