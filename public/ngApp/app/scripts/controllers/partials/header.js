'use strict';

/**
 * @ngdoc function
 * @name ngAppApp.controller:HeaderCtrl
 * @description
 * # HeaderCtrl
 * Controller of the ngAppApp
 */
angular.module('ngAppApp')
    .controller('HeaderCtrl', ['$scope', '$location', function ($scope, $location) {

        $scope.instruction = {};
        $scope.instruction.isVisible = false;

        $scope.instruction.show = function() {
            $scope.instruction.isVisible = true;
        };

        $scope.isActive = function(route) {
            return route === $location.path();
        }

    }]);
