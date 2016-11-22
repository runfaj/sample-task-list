var app = angular.module('app', [
  'ngRoute',
  'Controllers',
  'Services'
]);

app.config(['$routeProvider','$locationProvider', function($routeProvider, $locationProvider) {
    
    $locationProvider.html5Mode({
        enabled: true,
        requireBase: false
    });
    
    $routeProvider
        .when('/', {
            templateUrl: 'partials/index.html',
            controller: 'MainController'
        })
        .otherwise({
            redirectTo: '/'
        });

}]);