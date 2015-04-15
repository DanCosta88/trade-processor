'use strict';

/**
 * @ngdoc overview
 * @name ngAppApp
 * @description
 * # ngAppApp
 *
 * Main module of the application.
 */
angular
    .module('ngAppApp', [
    'ngAnimate',
    'ngCookies',
    'ngResource',
    'ngRoute',
    'ngSanitize',
    'ngTouch'
    ])

    .constant('urls', {
        BASE: 'http://currencyfair.dev',
        BASE_API: 'http://api.currencyfair.dev/v1'
    })

    .config(function ($routeProvider, $locationProvider, $httpProvider) {

        $locationProvider.html5Mode({
            enabled: true,
            requireBase: false
        });

        $httpProvider.defaults.headers.patch = {
            'Content-Type': 'application/json;charset=utf-8'
        };

        $routeProvider
          .when('/', {
            templateUrl: 'http://currencyfair.dev/ngApp/app/views/partials/main.html',
            controller: 'MainCtrl'
          })
          .when('/stats', {
            templateUrl: 'http://currencyfair.dev/ngApp/app/views/partials/stats.html',
            controller: 'StatsCtrl'
          })
          .when('/real-time', {
              templateUrl: 'http://currencyfair.dev/ngApp/app/views/partials/real-time.html',
              controller: 'StatsCtrl'
          })
          //.otherwise({
          //  redirectTo: '/dashboard'
          //});
    });
