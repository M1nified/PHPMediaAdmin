"use strict";

app.controller('AddFileCtrl',['$scope',function($scope){
    console.log('addFileCtrl');
    let files = [];
    let addFileSpot = function AddFileCtrl_addFileSpot() {
        console.log('AddFileCtrl_addFileSpot');
        files.push({});
    };
    
    $scope.files = files;
    $scope.addFileSpot = addFileSpot;
}])