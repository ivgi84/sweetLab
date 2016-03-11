var templateCtrls = angular.module('app.Ctrls', []);

templateCtrls.controller('mainCtrl', ['$scope','$state','app.factories.data', function ($scope, $state ,data) {
    $scope.isLoading = true;

    console.log();

    var page = {
        page:$state.current.name,
        lang:'ru'
    }

    data.getContent(page).then(function(data){
       $scope.content = data.data;
        console.log($scope.content);
        $scope.isLoading = false;
    });

}]);
