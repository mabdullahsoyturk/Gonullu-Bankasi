<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MessageGroupMembersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MessageGroupMembersTable Test Case
 */
class MessageGroupMembersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MessageGroupMembersTable
     */
    public $MessageGroupMembers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.message_group_members',
        'app.message_groups',
        'app.users',
        'app.groups',
        'app.users_groups'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('MessageGroupMembers') ? [] : ['className' => 'App\Model\Table\MessageGroupMembersTable'];
        $this->MessageGroupMembers = TableRegistry::get('MessageGroupMembers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MessageGroupMembers);

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
