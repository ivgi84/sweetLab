var myServices = angular.module('app.factories', []);

myServices.factory('app.factories.data', ['$http', function ($http) {

    var DataFactory = function () {
        var dataSrc = {
            folder: 'data/',
            main: {
                he: 'main/he-il.json',
                ru: 'main/ru-ru.json'
            },
            course: {
                he: 'course/he-il.json',
                ru: 'course/ru-ru.json'
            },
            workshop: {
                he: 'workshop/he-il.json',
                ru: 'workshop/ru-ru.json'
            }
        };

        this.getContent = function (obj) {
            console.log(dataSrc[obj.page]);
            if(obj.page!='' && obj.lang!=''){
                return $http.get(dataSrc.folder+''+dataSrc[obj.page][obj.lang])
                    .success(function (res) {
                        return res;
                    })
                    .error(function () {
                        return 'error';
                    });
            }

        };

        this.addUser = function (user) {
            return $http.post('bin/User.php?action=addUser', user)
                .success(function (res) {
                    console.log(res);
                    return res;
                })
                .error(function () {
                    return 'error';
                })
        }


    }

    return new DataFactory();

    //return{
    //
    //    getData:function(){
    //        return $http.get('data/he-il.json')
    //            .success(function(data){
    //                return data;
    //            })
    //            .error(function(){
    //                return 'error';
    //            })
    //    },
    //    addUser: function (user) {
    //        return $http.post('bin/User.php?action=addUser', user)
    //            .success(function(res){
    //                console.log(res);
    //        })
    //            .error(function(){
    //                return 'error';
    //            })
    //    }
    //}
}]);