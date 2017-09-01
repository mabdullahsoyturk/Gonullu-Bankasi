var ChatApp = angular.module('ChatApp', []);
    ChatApp.directive('ngEnter', function () {
        return function (scope, element, attrs) {
            element.bind("keydown keypress", function (event) {
                if (event.which === 13) {
                    scope.$apply(function (){
                        scope.$eval(attrs.ngEnter);
                    });
                    event.preventDefault();
                }
            });
        };
    });
ChatApp.controller('ChatAppCtrl', ['$scope', '$http', function($scope, $http) {
        $scope.urlListMessages = urlListMessages;
        $scope.urlSaveMessage = urlSaveMessage;
        $scope.groupId = groupId;
        $scope.username = username;
$scope.pidMessages = null;
$scope.pidPingServer = null;
$scope.beep = new Audio('http://spachat.zendelsolutions.com/beep.ogg');
$scope.messages = [];
$scope.lastMessageId = null;
$scope.historyFromId = null;
$scope.me = {
    username: $scope.username,
    message: null,
    groupId: $scope.groupId
};
$scope.pageTitleNotificator = {
    vars: {
        originalTitle: window.document.title,
        interval: null,
        status: 0
    },
    on: function(title, intervalSpeed) {
        var self = this;
        if (! self.vars.status) {
            self.vars.interval = window.setInterval(function() {
                window.document.title = (self.vars.originalTitle == window.document.title) ?
                    title : self.vars.originalTitle;
            },  intervalSpeed || 500);
            self.vars.status = 1;
        }
    },
    off: function() {
        window.clearInterval(this.vars.interval);
        window.document.title = this.vars.originalTitle;
        this.vars.status = 0;
    }
};
$scope.saveMessage = function(form, callback) {
    var data = $.param($scope.me);
    if (! ($scope.me.username && $scope.me.username.trim())) {
        return $scope.openModal();
    }
    if (! ($scope.me.message && $scope.me.message.trim() &&
            $scope.me.username && $scope.me.username.trim())) {
        return;
    }
    $scope.me.message = '';
    return $http({
        method: 'POST',
        url: $scope.urlSaveMessage,
        data: data,
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).success(function(data) {
        $scope.listMessages(true);
    });
};
$scope.replaceShortcodes = function(message) {
    var msg = '';
    msg = message.toString().replace(/(\[img])(.*)(\[\/img])/, "<img src='$2' />");
    msg = msg.toString().replace(/(\[url])(.*)(\[\/url])/, "<a href='$2'>$2</a>");
    return msg;
};
$scope.notifyLastMessage = function() {
    if (typeof window.Notification === 'undefined') {
        return;
    }
    window.Notification.requestPermission(function (permission) {
        var lastMessage = $scope.getLastMessage();
        if (permission == 'granted' && lastMessage && lastMessage.username) {
            var notify = new window.Notification(lastMessage.username + ' says:', {
                body: lastMessage.message
            });
            notify.onclick = function() {
                window.focus();
            };
            notify.onclose = function() {
                $scope.pageTitleNotificator.off();
            };
            var timmer = setInterval(function() {
                notify && notify.close();
                typeof timmer !== 'undefined' && window.clearInterval(timmer);
            }, 10000);
        }
    });
};
$scope.getLastMessage = function() {
    return $scope.messages[$scope.messages.length - 1];
};
$scope.listMessages = function(wasListingForMySubmission) {
    return $http.post($scope.urlListMessages, {}).success(function(data) {
        $scope.messages = [];
        angular.forEach(data, function(message) {
            message.message = $scope.replaceShortcodes(message.message);
            message.userImage = message.userImage ? profileImageBaseURL+message.userImage : 'http://upload.wikimedia.org/wikipedia/en/e/ee/Unknown-person.gif';

            $scope.messages.push(message);
        });
        var lastMessage = $scope.getLastMessage();
        var lastMessageId = lastMessage && lastMessage.id;
        if ($scope.lastMessageId !== lastMessageId) {
            $scope.onNewMessage(wasListingForMySubmission);
        }
        $scope.lastMessageId = lastMessageId;
    });
};
$scope.onNewMessage = function(wasListingForMySubmission) {
    if ($scope.lastMessageId && !wasListingForMySubmission) {
        $scope.playAudio();
        $scope.pageTitleNotificator.on('New message');
        $scope.notifyLastMessage();
    }
    $scope.scrollDown();
    window.addEventListener('focus', function() {
        $scope.pageTitleNotificator.off();
    });
};

$scope.init = function() {
    $scope.listMessages();
    $scope.pidMessages = window.setInterval($scope.listMessages, 3000);
    $scope.pidPingServer = window.setInterval($scope.pingServer, 8000);
};
$scope.scrollDown = function() {
    var pidScroll;
    pidScroll = window.setInterval(function() {
        $('.direct-chat-messages').scrollTop(window.Number.MAX_SAFE_INTEGER * 0.001);
        window.clearInterval(pidScroll);
    }, 100);
};
$scope.clearHistory = function() {
    var lastMessage = $scope.getLastMessage();
    var lastMessageId = lastMessage && lastMessage.id;
    lastMessageId && ($scope.historyFromId = lastMessageId);
};
$scope.openModal = function() {
    $('#choose-name').modal('show');
};
$scope.playAudio = function() {
    $scope.beep && $scope.beep.play();
};
$scope.init();
}]);