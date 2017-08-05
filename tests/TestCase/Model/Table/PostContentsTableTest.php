<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PostcontentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PostcontentsTable Test Case
 */
class PostcontentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PostcontentsTable
     */
    public $Postcontents;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.postcontents',
        'app.posts',
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
        $config = TableRegistry::exists('Postcontents') ? [] : ['className' => 'App\Model\Table\PostcontentsTable'];
        $this->Postcontents = TableRegistry::get('Postcontents', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Postcontents);

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
