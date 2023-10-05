<?php

namespace Tests\Unit;

use App\Models\Contact;
use App\Models\Tool;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactsTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_contact_returns_associated_tools()
    {
        // create a tool
        $tool = Tool::factory()->create();
        $contact = Contact::first();
        $this->assertEquals($tool->name, $contact->tools[0]->name);
    }
}
