<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
<?= $this->Html->css('messages.css'); ?>
<script type="text/javascript">
    var profileImageBaseURL = '<?= $this->Url->build('/files/Users/image/'); ?>'
    var urlListMessages='<?= $this->Url->build([
        "controller" => "Messages",
        "action" => "getPrivateMessages",
        $otherUserId
    ]); ?>';
    var urlSaveMessage='<?= $this->Url->build([
        "controller" => "Messages",
        "action" => "save"
    ]); ?>';
    var groupId='<?= $groupId; ?>';
    var username='<?= sprintf('%s %s', $user->first_name, $user->last_name); ?>';
</script>
<?= $this->Html->script('messagesApp.js'); ?>

<div class="container" ng-app="ChatApp" ng-controller="ChatAppCtrl">
    <div class="box box-warning direct-chat direct-chat-warning">
        <div class="box-body">
            <div class="direct-chat-messages">
                <div class="direct-chat-msg" ng-repeat="message in messages" ng-if="historyFromId < message.id" ng-class="{'right':!message.me}">
                    <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name" ng-class="{'pull-left':message.me, 'pull-right':!message.me}">{{ message.username }}</span>
                        <span class="direct-chat-timestamp " ng-class="{'pull-left':!message.me, 'pull-right':message.me}">{{ message.date }}</span>
                    </div>
                    <img class="direct-chat-img" ng-src="{{message.userImage}}" alt="">
                    <div class="direct-chat-text right">
                        <span>{{ message.message }}</span>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <form ng-submit="saveMessage()">
                    <div class="input-group">
                        <input type="text" placeholder="Type message..." autofocus="autofocus" class="form-control" ng-model="me.message" ng-enter="saveMessage()">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-warning btn-flat">Send</button>
                            </span>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal" id="choose-name">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Choose nickname</h4>
                </div>
                <div class="modal-body">
                    <label class="radio">Enter your username</label>
                    <input class="form-control" ng-model="me.username" autofocus="autofocus">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="clear-history">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Chat history</h4>
                </div>
                <div class="modal-body">
                    <label class="radio">Are you sure to clear chat history?</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal" ng-click="clearHistory()">Accept</button>
                </div>
            </form>
        </div>
    </div>
</div>