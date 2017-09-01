<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EventApplicationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EventApplicationsTable Test Case
 */
class EventApplicationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EventApplicationsTable
     */
    public $EventApplications;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.event_applications',
        'app.users',
        'app.groups',
        'app.users_groups',
        'app.events'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('EventApplications') ? [] : ['className' => 'App\Model\Table\EventApplicationsTable'];
        $this->EventApplications = TableRegistry::get('EventApplications', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EventApplications);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
