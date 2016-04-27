var app = angular.module('tamilMp3', ['ngRoute'])
        .directive('loading', ['$http', function ($http)
            {
                return {
                    restrict: 'A',
                    link: function (scope, elm, attrs)
                    {
                        scope.isLoading = function () {
                            return $http.pendingRequests.length > 0;
                        };

                        scope.$watch(scope.isLoading, function (v)
                        {
                            if (v) {
                                elm.show();
                            } else {
                                elm.hide();
                            }
                        });
                    }
                };

            }])
        .config(function ($routeProvider) {
            $routeProvider
                    .when("/", {
                        templateUrl: 'template/initial.html',
                        controller: 'mp3Ctrl'
                    })
                    .when("/azlisting/:alpha", {
                        templateUrl: 'template/az.php',
                        controller: 'azList'
                    })
                    .when("/movie/:name", {
                        templateUrl: 'template/album.php',
                        controller: 'albumCtrl'
                    })
                    .otherwise({redirectTo: '/'});
        })
        .controller('main', function ($scope) {
            $scope.banner = {};
            $scope.fetchedatoz = [];
            $scope.banner.visibility = true;
        })
        .controller('mp3Ctrl', function ($scope) {
            $scope.banner.visibility = true;
            $scope.message = "first";
        })
        .controller('azList', function ($scope, $routeParams, $http) {
            $scope.banner.visibility = true;
            $scope.indexChar = function (index) {
                return String.fromCharCode(65 + index);
            };
            $scope.getTimes = function (n) {
                return new Array(n);
            };
            var alpha = $routeParams.alpha;
            if (angular.isDefined($scope.fetchedatoz[alpha])) {
                $scope.list = $scope.fetchedatoz[alpha];
            } else {
                $http.get('ajax/azlist.php?alpha=' + alpha)
                        .then(function (response) {
                            $scope.list = response.data;
                            $scope.fetchedatoz[alpha] = response.data;
                        });
            }
        })
        .controller('albumCtrl', function ($scope, $routeParams) {
            $scope.banner.visibility = false;
            $scope.name = $routeParams.name;
        });


