myStock.controller('Main', ['$scope', '$http', function ($scope, $http) {
    $scope.settings = {};


    $http.get('api/settings.php').success(function (data) {
        console.log(data);
        $scope.settings = data;
    });

    //$scope.$watch('money', function (newValue, oldValue) {
    //    if (newValue && oldValue) {
    //        console.log('money changed! need save', arguments);
    //    }
    //});

    $scope.saveSettings = function (settings) {
        console.log('Save', settings);
    };
}]);