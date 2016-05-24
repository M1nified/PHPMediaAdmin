<?php
require_once realpath('~/../../../php/autoload.php');
?>
<div class="">
  <form class="" ng-submit="runFilter($event)">
    <div class="form-group row-in">
      <div class="col-md-6 col-lg-6 col-sm-6">
        <div class="form-group input-group ">
          <span class="input-group-addon" id="date1">Since:</span>
          <input type="date" name="since" class="form-control" placeholder="Date since" aria-describedby="date1" ng-model="find.since">
        </div>
      </div>
      <div class="col-md-6 col-lg-6 col-sm-6">
        <div class="form-group input-group ">
          <span class="input-group-addon" id="date2">Until:</span>
          <input type="date" name="until" class="form-control" placeholder="Date until" aria-describedby="date2" ng-model="find.until">
        </div>
      </div>
    </div>
    <div class="form-group input-group">
      <span class="input-group-addon" id="date3">Look for:</span>
      <input type="text" name="keywords" class="form-control" placeholder="keywords..." aria-describedby="date3" ng-model="find.keywords">
    </div>
    <input class="btn btn-success" type="submit" value="Find!">
  </form>
  <div class="">
    <table class="table table-striped">
      <thead>
      <tr>
        <th>
          Id
        </th>
        <th>
          Keywords
        </th>
        <th>
          Path
        </th>
        <th>
          Link
        </th>
      </tr>
    </thead>
    <tbody>
      <tr ng-repeat="row in search.results">
        <td>
          {{row.id}}
        </td>
        <td>
          {{row.keywords}}
        </td>
        <td>
          {{row.file_location}}
        </td>
        <td>
          <div class="form-inline">
            <div class="input-group">
              <div class="input-group-addon">Coded:</div>
              <input type="text" class="form-control" ng-value="'http://<?php printGetfilePath(); ?>?l='+row.mask" readonly>
            </div>
            <div class="input-group">
              <div class="input-group-addon">Normal:</div>
              <input type="text" class="form-control" ng-value="'http://<?php echo "{$_SERVER['HTTP_HOST']}"; ?>'+row.file_location" readonly>
            </div>
          </div>
        </td>
      </tr>
    </tbody>
    </table>
  </div>
</div>
