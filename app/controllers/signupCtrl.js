var templateCtrls = angular.module('app.Ctrls');

templateCtrls.controller('signupCtrl', ['$scope','app.factories.data', function ($scope, data) {

    $scope.save = function(isValid){
        if(isValid){
            console.log($scope.user);
            data.addUser($scope.user);
        }
        else{
            console.log('not valid');
        }
    }

}]);
