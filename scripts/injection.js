var app = angular.module('tamilMp3', ['ngRoute', 'ngAnimate'])
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
                    .when("/byyear", {
                        templateUrl: 'template/byyear.php',
                        controller: 'yearCtrl'
                    })
                    .when("/byyear/:year", {
                        templateUrl: 'template/byyearlist.php',
                        controller: 'yearlistCtrl'
                    })
                    .otherwise({redirectTo: '/'});
        })
        .controller('main', function ($scope) {
            $scope.banner = {};
            $scope.fetchedatoz = [];
            $scope.fetchedbyyear = [];
            $scope.banner.visibility = true;
        })
        .controller('mp3Ctrl', function ($scope) {
            $scope.banner.visibility = true;
            $scope.message = "first";
        })
        .controller('azList', function ($scope, $routeParams, $http) {
            $scope.banner.visibility = false;
            $scope.indexChar = function (index) {
                return String.fromCharCode(65 + index);
            };
            $scope.getTimes = function (n) {
                return new Array(n);
            };
            var alpha = $routeParams.alpha;
            if (angular.isDefined($scope.fetchedatoz[alpha])) {
                $scope.list1 = $scope.fetchedatoz[alpha]['list1'];
                $scope.list2 = $scope.fetchedatoz[alpha]['list2'];
                $scope.list3 = $scope.fetchedatoz[alpha]['list3'];
            } else {
                $http.get('ajax/azlist.php?alpha=' + alpha)
                        .then(function (response) {
                            $scope.fetchedatoz[alpha] = [];
                            $scope.list1 = response.data[0];
                            $scope.list2 = response.data[1];
                            $scope.list3 = response.data[2];
                            $scope.fetchedatoz[alpha]['list1'] = response.data[0];
                            $scope.fetchedatoz[alpha]['list2'] = response.data[1];
                            $scope.fetchedatoz[alpha]['list3'] = response.data[2];
                        });
            }
        })
        .controller('albumCtrl', function ($scope, $routeParams) {
            $scope.banner.visibility = false;
            $scope.name = $routeParams.name;
        })
        .controller('yearCtrl', function ($scope) {
            $scope.banner.visibility = false;
            $scope.years = [];
            $scope.years[0] = [];
            $scope.years[1] = [];
            $scope.years[2] = [];
            $scope.years[3] = [];
            var cyear = new Date().getFullYear();
            for (i = 0; i < 67; i++) {
                if (i < 17) {
                    $scope.years[0].push(cyear - i);
                } else if (i < 34) {
                    $scope.years[1].push(cyear - i);
                } else if (i < 51) {
                    $scope.years[2].push(cyear - i);
                } else {
                    $scope.years[3].push(cyear - i);
                }
            }
        })
        .controller('yearlistCtrl', function ($scope, $routeParams, $http) {
            $scope.banner.visibility = false;
            $scope.year = $routeParams.year;
            if (angular.isDefined($scope.fetchedbyyear[$routeParams.year])) {
                $scope.list1 = $scope.fetchedbyyear[$routeParams.year]['list1'];
                $scope.list2 = $scope.fetchedbyyear[$routeParams.year]['list2'];
                $scope.list3 = $scope.fetchedbyyear[$routeParams.year]['list3'];
            } else {
                $http.get('ajax/yearlist.php?year=' + $routeParams.year)
                        .then(function (response) {
                            $scope.fetchedbyyear[$routeParams.year] = [];
                            $scope.list1 = response.data[0];
                            $scope.list2 = response.data[1];
                            $scope.list3 = response.data[2];
                            $scope.fetchedbyyear[$routeParams.year]['list1'] = response.data[0];
                            $scope.fetchedbyyear[$routeParams.year]['list2'] = response.data[1];
                            $scope.fetchedbyyear[$routeParams.year]['list3'] = response.data[2];
                        });
            }
        });


