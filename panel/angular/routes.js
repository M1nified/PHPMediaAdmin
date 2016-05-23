"use strict";

angular.module('MediaAdmin').config(['$routeProvider',function($routeProvider){
    $routeProvider
    .when('/add',{
        templateUrl:'template/add.html',
        controller:'AddFileCtrl'
    })
    .otherwise({
        redirectTo:'/add'
    });
}]);