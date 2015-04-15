'use strict';

/**
 * @ngdoc function
 * @name ngAppApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the ngAppApp
 */
angular.module('ngAppApp')
  .controller('StatsCtrl', function ($scope) {

        $scope.isActive = function(route) {
            return route === $location.path();
        }
        
  });
