<?php

namespace Tests\Integration\Contacts;

use  Ourvoice\Sdk\Common\HttpClient;
use  Ourvoice\Sdk\Exceptions\ServerException;
use  Ourvoice\Sdk\Objects\BaseList;
use  Ourvoice\Sdk\Objects\Contact;
use  Ourvoice\Sdk\Objects\Account;
use Tests\Integration\BaseTest;

class ContactTest extends BaseTest
{
    /*public function testCreateContact(): void
    {
        $account = new Account();
        $contact = new Contact();
        $contact->first_name = "John";
        $contact->last_name = "Doe";
        $contact->phone_number = "31612345678";
        $contact->langue = "fon";
        $contact->custom_fields = "Customfield2";
        $contact->account_id = $account->id;

        $this->mockClient->expects(self::once())->method('performHttpRequest')->willReturn([
            200,
            '',
            '{
            "id": "61afc0531573b08ddbe36e1c85602827",
            "href": "https://staging.getourvoice.com/api/v1/contacts/61afc0531573b08ddbe36e1c85602827",
            "first_name": "John",
            "last_name": "Doe",
            "phone_number": "31612345678",
            "langue": "fon",
            "custom_fields": "Customfield2",
            "account_id": "$account->id",
            
        }',
        ]);
        
        $this->client->contacts->create($contact);
    }*/

    public function testListContacts(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "GET",
            'contacts',
            ['offset' => 100, 'limit' => 30],
            null
        );
        $this->client->contacts->getList(['offset' => 100, 'limit' => 30]);
    }

    public function testViewContact(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "GET",
            'contacts/contact_id',
            null,
            null
        );
        $this->client->contacts->read("contact_id");
    }

    public function testDeleteContact(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "DELETE",
            'contacts/contact_id',
            null,
            null
        );
        $this->client->contacts->delete("contact_id");
    }

    

    
}
