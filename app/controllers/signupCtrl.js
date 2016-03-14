var templateCtrls = angular.module('app.Ctrls');

templateCtrls.controller('signupCtrl', ['$scope','$state','app.factories.data', function ($scope,$state,data) {

    $scope.sendSuccess = false;
    $scope.sendFail = false;
    $scope.sending = false;

    $scope.save = function(isValid){
        if(isValid){
            $scope.sending = true;
            $scope.user.subscribed = $state.current.name;
            data.addUser($scope.user).then(function (res) {
                console.log(res.data);
                if(res.data.result){
                    $scope.sendSuccess = true;
                }
                else{
                    $scope.sendFail = true;
                }
            }).finally(function () {
                $scope.sending = false;
            })
        }
        else{
            console.log('not valid');
        }
    }

}]);
