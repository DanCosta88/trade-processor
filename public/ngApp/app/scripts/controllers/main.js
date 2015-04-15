'use strict';

/**
 * @ngdoc function
 * @name ngAppApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the ngAppApp
 */
angular.module('ngAppApp')
    .controller('MainCtrl', function ($scope, $location) {

        $scope.instruction = {};
        $scope.instruction.isVisible = false;

        $scope.instruction.show = function() {
            $scope.instruction.isVisible = true;
        };

        $scope.isActive = function(route) {
            console.log($location.path());
            return route === $location.path();
        }


    });
