"use strict";

angular.module('MediaAdmin').controller('AddFileCtrl',['$scope',function($scope){
    console.log('AddFileCtrl');
    let files = [];
    let addFileSpot = function AddFileCtrl_addFileSpot() {
        console.log('AddFileCtrl_addFileSpot');
        files.push({type:'filespot'});
    };
    let addFileLink = function AddFileCtrl_addFileLink(){
        files.push({type:'filelink'});
    };
    let uploadFile = function AddFileCtrl_uploadFile(evt,index,fileoffiles){
        evt.preventDefault();
        console.log('AddFileCtrl_uploadFile');
        let file = files[index];
        let filesarr = evt.target.files.files;
        file.files = filesarr;
        console.log(files)
        sendFile(file);
    };
    let sendFile = function AddFileCtrl_sendFile(file){
         console.log(file);  
         let fd = new FormData();
         fd.append('filename',file.filename || '');
         fd.append('keywords',file.keywords || '');
         for(let i=0;i<file.files.length;i++){
             fd.append('files[]',file.files[i],file.files[i].name);
         }
         console.log(fd);
         let xhr = new XMLHttpRequest();
         xhr.open('POST','action/addFiles.php',true);
        //  xhr.setRequestHeader('Content-type', 'multipart/form-data; charset=utf-8');
         xhr.onload = function(){
             console.log(xhr.status);
             console.log(xhr.response);
         }
         xhr.send(fd);
    };
    let linkFile = function AddFileCtrl_linkFile(evt,index,fileoffiles){
        let fd = new FormData();
        fd.append('files',fileoffiles.files || '');
        fd.append('keywords',fileoffiles.keywords || '');
        let xhr = new XMLHttpRequest();
        xhr.open('POST','action/linkFiles.php',true);
        xhr.onload = function(){
            console.log(xhr.status);
            console.log(xhr.response);
        }
        xhr.send(fd);
    };

    $scope.files = files;
    $scope.addFileSpot = addFileSpot;
    $scope.addFileLink = addFileLink;
    $scope.uploadFile = uploadFile;
    $scope.linkFile = linkFile;
}])