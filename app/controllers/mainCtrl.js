var templateCtrls = angular.module('app.Ctrls', []);

templateCtrls.controller('mainCtrl', ['$scope','$state','$stateParams','app.factories.data', function ($scope, $state, $stateParams ,data) {

    $scope.isLoading = true;

    var page = {
        page:$state.current.name,
        lang: $stateParams.lang || 'he',
    }
    $scope.isRtl = (page.lang == 'he') ? true : false;

    var getLang = function () {
        $scope.isLoading = true;
        data.getContent(page).then(function(data){
            console.log(data.data);
            $scope.content = data.data;
            $scope.isLoading = false;
        });
    };

    getLang();

    $scope.setLang = function (lang) {
        $state.go(page.page, {lang:lang});
    }

}]);
