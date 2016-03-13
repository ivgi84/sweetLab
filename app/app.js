var app = angular.module('app', ['ngSanitize', 'ui.router','ngAnimate', 'app.Ctrls', 'app.factories']);

app.config(['$stateProvider', '$urlRouterProvider', '$locationProvider', function ($stateProvider, $urlRouterProvider, $locationProvider) {
    //$locationProvider.html5Mode({enabled: true, requireBase: false});

    $urlRouterProvider.otherwise("/main/");

    $stateProvider
        .state('main', {
            url: '/main/:lang',
            templateUrl: 'partials/main.html',
            controller: 'mainCtrl'
        }).
        state('course', {
            url: '/course/:lang',
            templateUrl: 'partials/course.html',
            controller: 'mainCtrl'
        }).
        state('workshop', {
            url: '/workshop/:lang',
            templateUrl: 'partials/workshop.html',
            controller: 'mainCtrl'
        });
}]);