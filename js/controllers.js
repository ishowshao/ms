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
    $scope.suggests = [];
    $scope.operation = 'buy';
    $scope.amount = 100;
    $scope.$watch('code', function (value) {
        if (value) {
            $http.get('api/suggest.php?key=' + encodeURIComponent(value)).success(function (data) {
                console.log(data);
                $scope.suggests = data;
            });
        }
    });
    $scope.selectSuggest = function (suggest) {
        $scope.code = suggest.code;
        $scope.id = suggest.id;
    };
    $scope.addStock = function () {
        $http.post('api/stock.php', {
            code: $scope.code,
            id: $scope.id,
            amount: $scope.amount
        }).success(function (data) {
            console.log(data);
        });
    };
}]);