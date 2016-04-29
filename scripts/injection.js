var app = angular.module('tamilMp3', ['ngRoute', 'ngAnimate'])
        .directive('loading', ['$http', function ($http) //Directive defined to show Loading Screen
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
        .config(function ($routeProvider) {                         //Following are the Routing Condition to Different Templates
            $routeProvider
                    .when("/", {//Index Page
                        templateUrl: 'template/initial.html',
                        controller: 'mp3Ctrl'
                    })
                    .when("/azlisting/:alpha", {//A-Z Movie Listing
                        templateUrl: 'template/az.php',
                        controller: 'azList'
                    })
                    .when("/movie/:name", {//Album Page
                        templateUrl: 'template/album.php',
                        controller: 'albumCtrl'
                    })
                    /*.when("/byyear", {                              //Year Listing Page
                     templateUrl: 'template/byyear.php',
                     controller: 'yearCtrl'
                     })
                     .when("/byyear/:year", {                        //Year Inner Page
                     templateUrl: 'template/byyearlist.php',
                     controller: 'yearlistCtrl'
                     })*/
                    .when("/StarHits/", {//Star Hits Page
                        templateUrl: 'template/starhits.php',
                        controller: 'starhitsCtrl'
                    })
                     .when("/MusicDirectorHits/", {//Album Page
                        templateUrl: 'template/starhits.php',
                        controller: 'directorCtrl'
                    })
                    .otherwise({redirectTo: '/'});
        })
        .controller('main', function ($scope) {                     //Main Controller (mainly used For Caching)
            $scope.banner = {};
            $scope.fetchedatoz = [];
            $scope.fetchedbyyear = [];
            $scope.banner.visibility = true;
        })
        .controller('mp3Ctrl', function ($scope) {                  //Not in Use and Left for Reference(Donot Remove)
            $scope.banner.visibility = true;
            $scope.message = "first";
        })
        .controller('starhitsCtrl', function ($scope, $http) {      //Controller for Star Hits Template Page
            $scope.banner.visibility = true;
            $scope.location = "star_images";                        //Location of Star Images
            $http.post('ajax/list.php', {
                loc: "../admin/"                                    //Location of Folder
            })
                    .then(function (response) {
                        $scope.list = response.data;
                    });
        })
        .controller('directorCtrl', function ($scope, $http) {      //Controller for Star Hits Template Page
            $scope.banner.visibility = true;
            $scope.location = "director_images";                        //Location of Music Director Images
            $http.post('ajax/list.php', {
                loc: "../admin/"                                    //Location of Folder
            })
                    .then(function (response) {
                        $scope.list = response.data;
                    });
        })
        .controller('azList', function ($scope, $routeParams, $http) {  //Controller for A-Z Movie Listing Template Page
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
        .controller('albumCtrl', function ($scope, $routeParams, $http) {
            $scope.banner.visibility = false;
            $scope.name = $routeParams.name;
            var name = $routeParams.name;
            $http.get('ajax/songlist.php?name=' + name)
                    .then(function (response) {
                        $scope.list = response.data;
                        $scope.detail = response.data.detail;
                        console.log($scope.list);
                    });
        })
        /*.controller('yearCtrl', function ($scope) {                     //Controller for Year Listing
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
         .controller('yearlistCtrl', function ($scope, $routeParams, $http) {  //Controller For Year Listing Inner Page
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
         })*/;


