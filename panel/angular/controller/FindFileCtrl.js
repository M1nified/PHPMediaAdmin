"use strict";

angular.module('MediaAdmin').controller('FindFileCtrl',['$scope',function($scope){
    console.log('FindFileCtrl');
    let find = {}
    let objToUrl = (obj)=>{
        let str = [];
        for(let key of Object.keys(obj)){
            str.push(key+"="+(obj[key] || ''));
        }
        str = '?'+str.join('&');
        str = str.replace(/ /g,'+');
        return str;
    }
    let runFilter = function FindFileCtrl_runFilter(evt) {
        let query = objToUrl(find);
        console.log(find);
        console.log(query)
        let xhr = new XMLHttpRequest();
        xhr.open('POST','action/findFiles.php'+query,true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onload = () => {
            console.log(xhr.response)
        }
        xhr.onerror = (e) => {
            console.error(e);
        }
        xhr.onprogress = (e) => {
            console.log(e);
        }
        xhr.send();
    }
    
    $scope.find = find;
    $scope.runFilter = runFilter;
}])