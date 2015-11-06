var myStock = angular.module('myStock', [
    'ngRoute',
    'controllers'
]);
myStock.config([
    '$routeProvider',
    function ($routeProvider) {
        $routeProvider.when('/settings', {
            templateUrl: 'partials/settings.html',
            controller: 'settings'
        }).when('/stock', {
            templateUrl: 'partials/stock.html',
            controller: 'stock'
        }).when('/operation', {
            templateUrl: 'partials/operation.html',
            controller: 'operation'
        }).otherwise({
            redirectTo: '/settings'
        });
    }
]);