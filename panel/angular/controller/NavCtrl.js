"use strict";
angular.module('MediaAdmin').controller('NavCtrl',['$scope','$location','$rootScope',function($scope,$location,$rootScope){
    $rootScope.$on('$locationChangeSuccess',function(){
        $scope.path = $location.path();
    })
}]);