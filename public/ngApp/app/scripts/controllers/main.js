'use strict';

/**
 * @ngdoc function
 * @name ngAppApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the ngAppApp
 */
angular.module('ngAppApp')
.controller('MainCtrl', ['$scope', '$localStorage', function ($scope, $localStorage) {

    $scope.instruction = {};

    if(! $localStorage.openInstruction) {
        $scope.instruction.isVisible = false;
    } else {
        $scope.instruction.isVisible = true;
    }

    $scope.instruction.show = function() {
        $scope.instruction.isVisible = true;
        $localStorage.openInstruction = true;
    };

}]);
