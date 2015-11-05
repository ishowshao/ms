myStock.controller('settings', ['$scope', '$http', function ($scope, $http) {
    $scope.settings = {};


    $http.get('api/settings.php').success(function (data) {
        console.log(data);
        $scope.settings = data;
    });

    $scope.saveSettings = function (settings) {
        $http.post('api/settings.php', settings).success(function (data) {
            console.log(data);
        });
        console.log('Save', settings);
    };
}]);

myStock.controller('stock', ['$scope', '$http', function ($scope, $http) {
    $scope.stocks = [
        {code: '100001', name: '上证', amount: 100, costPrice: 10000, currentPrice: 9999, pl: 1, plRate: 0.1, todo: ''}
    ];
}]);

myStock.controller('operation', ['$scope', '$http', function ($scope, $http) {
    $scope.record = {
        amount: 100,
        operation: 'buy'
    };
    $scope.suggests = [];
    $scope.$watch('record.code', function (value) {
        if (value) {
            $http.get('api/suggest.php?key=' + encodeURIComponent(value)).success(function (data) {
                $scope.suggests = data;
            });
        }
    });
    $scope.selectSuggest = function (suggest) {
        $scope.record.code = suggest.code;
        $scope.record.id = suggest.id;
    };
    $scope.addRecord = function () {
        $http.post('api/operation.php', $scope.record).success(function (data) {
            console.log(data);
        });
    };
}]);