var templateCtrls = angular.module('app.Ctrls', []);

templateCtrls.controller('mainCtrl', ['$scope','app.factories.data', function ($scope, data) {
    $scope.isLoading = true;

    data.getData().then(function(data){
       $scope.content = data.data;
        console.log($scope.content);
        $scope.isLoading = false;
    });

}]);
