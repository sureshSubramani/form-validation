
<!DOCTYPE html>
<html>
 <head>
  <title>AngularJS with Validation</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
 </head>
 <body>
  <br /><br />
  <div class="container" style="width:750px;">
   <h3 class="text-center">Submit Form Data by using AngularJS with Validation using PHP</h3>
   <br /><br />
   <div ng-app="myapp" ng-controller="formcontroller">
    <form name="userForm" ng-submit="insertData()">
     <label class="text-success" ng-show="successInsert">{{successInsert}}</label>
     <div class="form-group">
      <label>First Name <span class="text-danger">*</span></label>
      <input type="text" name="first_name" ng-model="first_name" class="form-control" />
      <span class="text-danger" ng-show="errorFirstname">{{errorFirstname}}</span>
      <span>{{first_name}}</span>
     </div>
     <div class="form-group">
      <label>Last Name <span class="text-danger">*</span></label>
      <input type="text" name="last_name" ng-model="last_name" class="form-control" />
      <span class="text-danger" ng-show="errorLastname">{{errorLastname}}</span>
     </div>
     <br />
     <div class="form-group">
      <input type="submit" name="insert" class="btn btn-info" value="Insert"/>
     </div>
    </form>
   </div>
  </div>
 </body>
</html>

<script>
var base_url = window.location.origin+"/";
var application = angular.module("myapp", []);
application.controller("formcontroller", function($scope, $http){
 //$scope.insert = {};
 $scope.insertData = function(){
  $http({
   method:"POST",
   url:"home/insert",
   data:{ 
            first_name: $scope.first_name,
            last_name: $scope.last_name,
        },
   headers: {'Content-Type': 'application/json'}
  }).success(function(data){
      console.log(data);
   if(data.error)
   {
    $scope.errorFirstname = data.error.first_name;
    $scope.errorLastname = data.error.last_name;
    $scope.successInsert = null;
   }
   else
   {
    $scope.insert = null;
    $scope.errorFirstname = null;
    $scope.errorLastname = null;
    $scope.successInsert = data.message;
   }
  });
 }
});
</script>

