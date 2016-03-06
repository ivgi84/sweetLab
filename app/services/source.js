var myServices = angular.module('app.factories',[]);

myServices.factory('app.factories.data',['$http', function ($http) {
    return{

        getData:function(){
            return $http.get('data/he-il.json')
                .success(function(data){
                    return data;
                })
                .error(function(){
                    return 'error';
                })
        },
        addUser: function (user) {
            return $http.post('bin/User.php?action=addUser', user)
                .success(function(res){
                    console.log(res);
            })
                .error(function(){
                    return 'error';
                })
        }
    }
}]);