var parkingTrackerControllers = angular.module('parkingTrackerControllers', []);

parkingTrackerControllers.controller('BlockfaceListController', ['$scope', 'Blockface', function ($scope, Blockface) {
  $scope.blockfaces = Blockface.query();
  $scope.predicate = ['Block','Face','Stall'];
}]);
