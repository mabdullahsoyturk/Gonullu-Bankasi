<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MessageGroupsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MessageGroupsTable Test Case
 */
class MessageGroupsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MessageGroupsTable
     */
    public $MessageGroups;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.message_groups',
        'app.creators',
        'app.message_group_members',
        'app.users',
        'app.groups',
        'app.users_groups',
        'app.messages'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('MessageGroups') ? [] : ['className' => 'App\Model\Table\MessageGroupsTable'];
        $this->MessageGroups = TableRegistry::get('MessageGroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MessageGroups);

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
