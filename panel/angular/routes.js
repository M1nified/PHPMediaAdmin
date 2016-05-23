"use strict";

angular.module('MediaAdmin').config(['$routeProvider',function($routeProvider){
    $routeProvider
    .when('/add',{
        templateUrl:'template/add.html.php',
        controller:'AddFileCtrl'
    })
    .when('/find',{
        templateUrl:'template/find.html.php',
        controller:'FindFileCtrl'
    })
    .otherwise({
        redirectTo:'/add'
    });
}]);