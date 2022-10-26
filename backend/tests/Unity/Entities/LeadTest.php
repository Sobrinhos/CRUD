<?php

namespace Youtube\Crud\Tests\Entities\LeadTest;

use PHPUnit\Framework\TestCase;
use Youtube\Crud\Entities\Lead;
use Youtube\Crud\Model\LeadModel;

class LeadTest extends TestCase
{
    public function testCreateNewLeadReturnInt()
    {
        $leadModel = new LeadModel();
        $lead = new Lead("mudou@email.com", $leadModel);
        $leadRusultId = $lead->save();
        $lead->deleteById($leadRusultId);
        $this->assertIsInt($leadRusultId, "Retorno recebido: " . $leadRusultId);
    }

    public function testFindAllLeadReturnArrayOfLeads()
    {
        $leadModel = new LeadModel();
        $lead = new Lead("mudou@email.com", $leadModel);
        $leadRusultId = $lead->save();
        $leadRusultArray = $lead->findAll();
        $lead->deleteById($leadRusultId);
        $this->assertIsArray($leadRusultArray);
    }

    public function testUpdateByIdReturnTrueWhenAllOk()
    {
        $leadModel = new LeadModel();
        $lead = new Lead("test@email.com", $leadModel);
        $leadRusultId = $lead->save();

        $lead->setEmail("mudou@email.com");
        $leadRusultUpdate = $lead->updateById($leadRusultId);
        $lead->deleteById($leadRusultId);
        $this->assertTrue($leadRusultUpdate);
    }

    public function testUpdateByIdShouldUpdateInDatabase()
    {
        $emailExpected = "mudou@email.com";
        $leadModel = new LeadModel();
        $lead = new Lead("test@email.com", $leadModel);
        $leadRusultId = $lead->save();

        $lead->setEmail($emailExpected);
        $leadRusultUpdate = $lead->updateById($leadRusultId);

        $leadResultFindById = $lead->findById($leadRusultId);
        $lead->deleteById($leadRusultId);
        $this->assertEquals($emailExpected, $leadResultFindById['email']);
    }

    public function testDeleteByIdReturnTrueWhenAllOk()
    {
        $leadModel = new LeadModel();
        $lead = new Lead("test@email.com", $leadModel);
        $leadRusultId = $lead->save();

        $this->assertTrue($lead->deleteById($leadRusultId));
    }

    public function testFindByIdReturnFalseWhenLeadAsDeleted()
    {
        $leadModel = new LeadModel();
        $lead = new Lead("test@email.com", $leadModel);
        $leadRusultId = $lead->save();

        $this->assertTrue($lead->deleteById($leadRusultId));
        $this->assertFalse($lead->findById($leadRusultId));
    }
}
