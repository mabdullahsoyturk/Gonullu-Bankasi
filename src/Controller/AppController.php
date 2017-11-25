<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\I18n\I18n;
use Cake\ORM\TableRegistry;
use App\Utility\NotificationManager;
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
  public $helpers = [
      'Form' => [
          'className' => 'Bootstrap.Form'
      ],
      'Html' => [
          'className' => 'Bootstrap.Html'
      ],
      'Modal' => [
          'className' => 'Bootstrap.Modal'
      ],
      'Navbar' => [
          'className' => 'Bootstrap.Navbar'
      ],
      'Paginator' => [
          'className' => 'Bootstrap.Paginator'
      ],
      'Panel' => [
          'className' => 'Bootstrap.Panel'
      ]
  ];
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Notifier');
        $notificationManager = NotificationManager::instance();
        $notificationManager->addTemplate('event_changed', [
        'title' => __("':event_title' has edited"),
        'body' => __('There has been changes in the event, please re-confirm your application.') . "<a href=':event_link'>asd</a>"
        ]);

        $notificationManager->addTemplate('new_event', [
        'title' => __("Call for volunteers: ':event_title'"),
        'body' => __('There is a new event call!') . "<a href=':event_link'>:event_title</a>"
        ]);

        $notificationManager->addTemplate('new_application', [
        'title' => __("1 application to ':event_title'"),
        'body' => __('There is a new application!') . ' '. __('Check it! ') . "<a href=':event_link'>:event_title</a>"
        ]);

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
       'authorize'=> 'Controller',
       'authenticate' => [
           'Form' => [
               'fields' => [
                   'username' => 'email',
                   'password' => 'password'
                 ],
                       'finder'=>'auth',
           ]
       ],
       'loginAction' => [
           'controller' => 'Users',
           'action' => 'login'
       ],
       'unauthorizedRedirect' => $this->referer() // If unauthorized, return them to page they were just on
   ]);
   $this->Auth->allow(['display']);

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see http://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');

        $notification_count = sizeof($this->Notifier->getNotifications(null, 1));
        $this->notification_count = $notification_count;
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
      $this->set('notification_count', $this->notification_count);

      $session = $this->request->session();
      if (!$session->check('Config.language')) {
        $session->write('Config.language', 'en');
      }
      $lang = $session->read('Config.language');
      I18n::locale($lang);
      $this->set('lang',$lang);

      $this->loadModel('VolunteamsPosts');

      $posts = TableRegistry::get('PostContents')->find('all')->select(['c.featured_title', 'post_id'])->join([
        'table' => 'volunteams_posts',
        'alias' => 'c',
        'type' => 'INNER',
        'conditions' => 'c.post_id = PostContents.post_id and language = "' . $lang . '"',
    ])->toArray();
      $this->set('posts', $posts);
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

    public function isAuthorized($user)
    {
      return false;
    }
}
