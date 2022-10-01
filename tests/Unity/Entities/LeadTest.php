<?php

namespace Youtube\Crud\Tests\Entities\LeadTest;

use PHPUnit\Framework\TestCase;
use Youtube\Crud\Entities\Lead;

class LeadTest extends TestCase
{
    public function testCreateNewLeadReturnInt()
    {
        $lead = new Lead("mudou@email.com");
        $leadRusultId = $lead->save();
        $lead->deleteById($leadRusultId);
        $this->assertIsInt($leadRusultId, "Retorno recebido: " . $leadRusultId);
    }

    public function testFindAllLeadReturnArrayOfLeads()
    {
        $lead = new Lead("mudou@email.com");
        $leadRusultId = $lead->save();
        $leadRusultArray = $lead->findAll();
        $lead->deleteById($leadRusultId);
        $this->assertIsArray($leadRusultArray);
    }

    public function testUpdateByIdReturnTrueWhenAllOk()
    {
        $lead = new Lead("test@email.com");
        $leadRusultId = $lead->save();

        $lead->setEmail("mudou@email.com");
        $leadRusultUpdate = $lead->updateById($leadRusultId);
        $lead->deleteById($leadRusultId);
        $this->assertTrue($leadRusultUpdate);
    }

    public function testUpdateByIdShouldUpdateInDatabase()
    {
        $emailExtect = "mudou@email.com";
        $lead = new Lead("test@email.com");
        $leadRusultId = $lead->save();

        $lead->setEmail($emailExtect);
        $leadRusultUpdate = $lead->updateById($leadRusultId);

        $leadResultFindById = $lead->findById($leadRusultId);
        $lead->deleteById($leadRusultId);
        $this->assertEquals($emailExtect, $leadResultFindById['email']);
    }

    public function testDeleteByIdReturnTrueWhenAllOk()
    {
        $lead = new Lead("test@email.com");
        $leadRusultId = $lead->save();

        $this->assertTrue($lead->deleteById($leadRusultId));
    }

    public function testFindByIdReturnFalseWhenLeadAsDeleted()
    {
        $lead = new Lead("test@email.com");
        $leadRusultId = $lead->save();

        $this->assertTrue($lead->deleteById($leadRusultId));
        $this->assertFalse($lead->findById($leadRusultId));
    }
}
