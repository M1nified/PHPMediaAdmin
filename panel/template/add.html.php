<?php
require_once realpath('~/../../../php/autoload.php');
?>
<div class="">
  <div class="navbar navbar-default">
    <p class="navbar-text">Actions:</p>
    <button class="btn btn-primary navbar-btn" ng-click="addFileSpot()">Add file</button>
  </div>
  <div class="">
    <form class="" action="index.html" method="post">
      <div class="panel panel-default" ng-repeat="file in files">
        <div class="panel-body">
            <div class="form-group input-group">
              <span class="input-group-addon" id="filename{{$index}}"><?php echo $GLOBALS['PMA_CONFIG']['files_location']; ?></span>
              <input type="text" name="file_name" class="form-control" placeholder="File name" aria-describedby="filename{{$index}}" ng-model="file.filename">
            </div>
            <div class="form-group input-group">
              <span class="input-group-addon" id="file{{$index}}">File: </span>
              <input type="file" name="files" class="form-control" aria-describedby="file{{$index}}" ng-model="file.file" multiple>
            </div>
            <div class="form-group input-group">
              <span class="input-group-addon" id="file{{$index}}">Keywords: </span>
              <input type="text" name="keywords" class="form-control" placeholder="Keywords (space separated)" aria-describedby="file{{$index}}" ng-model="file.keywords">
            </div>
            <input type="submit" class="btn btn-success" value="Upload">
            <button class="btn btn-danger" ng-click="files.splice($index,1)">Cancel</button>
        </div>
      </div>
      <button class="btn btn-success" ng-show="files.length>0">Upload all files</button>
    </form>
  </div>
</div>
