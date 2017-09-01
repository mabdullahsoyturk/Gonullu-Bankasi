<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VolunteamsPostsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VolunteamsPostsTable Test Case
 */
class VolunteamsPostsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VolunteamsPostsTable
     */
    public $VolunteamsPosts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.volunteams_posts',
        'app.posts',
        'app.users',
        'app.groups',
        'app.users_groups',
        'app.post_contents'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('VolunteamsPosts') ? [] : ['className' => 'App\Model\Table\VolunteamsPostsTable'];
        $this->VolunteamsPosts = TableRegistry::get('VolunteamsPosts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VolunteamsPosts);

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
