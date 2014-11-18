var parkingTrackerServices = angular.module('parkingTrackerServices', ['ngResource']);

parkingTrackerServices.factory('Blockface', ['$resource',
  function ($resource) {
    return $resource('/api/v1/index.php/blockfaces', {}, {
      query: {method:'GET', params: {}, isArray: true}
    });
  }
]);
