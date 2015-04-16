'use strict';

/**
 * @ngdoc function
 * @name ngAppApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the ngAppApp
 */
angular.module('ngAppApp')
.controller('MainController', ['$scope', function ($scope) {

    $scope.instruction = {};
    $scope.now = new Date();

    $scope.exp = new Date($scope.now.getFullYear(), $scope.now.getMonth(), $scope.now.getDate()+1);


    if(! $scope.instruction.isVisible) {
        $scope.instruction.isVisible = false;
    }

    $scope.instruction.show = function() {
        $scope.instruction.isVisible = true;
    };

}]);
