myStock.controller('settings', ['$scope', '$http', function ($scope, $http) {
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
        $http.post('api/settings.php', settings).success(function (data) {
            console.log(data);
        });
        console.log('Save', settings);
    };
}]);

myStock.controller('stock', ['$scope', '$http', function () {

}]);