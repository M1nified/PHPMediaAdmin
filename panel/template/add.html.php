<?php
require_once realpath('~/../../../php/autoload.php');
?>
<div class="">
  <div class="navbar navbar-default">
    <p class="navbar-text">Actions:</p>
    <button class="btn btn-primary navbar-btn" ng-click="addFileSpot()" title="Upload and link file">Add file</button>
    <button class="btn btn-primary navbar-btn" ng-click="addFileLink()" title="Link existing file">Link file</button>
    <button class="btn btn-primary navbar-btn" ng-click="addLinkSpot()" title="Add link to already uploaded file">Add link</button>
  </div>
  <div class="">
      <div class="panel panel-default" ng-repeat="file in files">
        <form class="" method="post" ng-submit="uploadFile($event,$index)">
        <div class="panel-body">
            <div class="form-group input-group">
              <span class="input-group-addon" id="filename{{$index}}"><?php echo $GLOBALS['PMA_CONFIG']['files_location']; ?>/</span>
              <input type="text" name="file_name" class="form-control" placeholder="File name" aria-describedby="filename{{$index}}" ng-model="file.filename">
            </div>
            <div class="form-group input-group">
              <span class="input-group-addon" id="file{{$index}}">File: </span>
              <input type="file" name="files" class="form-control" aria-describedby="file{{$index}}" ng-model="file.files" multiple required>
            </div>
            <div class="form-group input-group">
              <span class="input-group-addon" id="file{{$index}}">Keywords: </span>
              <input type="text" name="keywords" class="form-control" placeholder="Keywords (space separated)" aria-describedby="file{{$index}}" ng-model="file.keywords" required>
            </div>
            <button class="btn btn-danger" ng-click="files.splice($index,1)">Cancel</button>
            <input type="submit" class="btn btn-success" value="Upload">
        </div>
      </form>
      </div>
    <!--<button class="btn btn-success" ng-show="files.length>0">Upload all files</button>-->
  </div>
</div>
