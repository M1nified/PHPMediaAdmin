"use strict";

app.controller('AddFileCtrl',['$scope',function($scope){
    console.log('addFileCtrl');
    let addFileSpot = function AddFileCtrl_addFileSpot() {
        console.log('AddFileCtrl_addFileSpot');
    };
    
    
    $scope.addFileSpot = addFileSpot;
}])
