var app = angular.module('tamilMp3', ['ngRoute', 'ngAnimate'])
        .directive('loading', ['$http', function ($http)            //Directive defined to show Loading Screen on Ajax Call
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
                    .when("/", {                                    //Index Page
                        templateUrl: 'template/initial.html',
                        controller: 'mp3Ctrl'
                    })
                    .when("/azlisting/:alpha", {                    //A-Z Movie Listing
                        templateUrl: 'template/az.php',
                        controller: 'azList'
                    })
                    .when("/Album/:place/:name", {                  //Album Page
                        templateUrl: 'template/album.php',
                        controller: 'albumCtrl'
                    })
                    .when("/List/:place", {                         //List Common Page
                        templateUrl: 'template/3col.php',
                        controller: 'listCtrl'
                    })
                    .when("/NewReleases", {                         //List Common Page
                        templateUrl: 'template/new.php',
                        controller: 'newCtrl'
                    })
                    .when("/:place", {                              //Hits Common Page
                        templateUrl: 'template/hits.php',
                        controller: 'listCtrl'
                    })
                    .when("/List2/:place", {//List 2col Common Page
                        templateUrl: 'template/2col.php',
                        controller: 'listCtrl'
                    })
                    /*.when("/byyear", {                              //Year Listing Page
                     templateUrl: 'template/byyear.php',
                     controller: 'yearCtrl'
                     })
                     .when("/byyear/:year", {                        //Year Inner Page
                     templateUrl: 'template/byyearlist.php',
                     controller: 'yearlistCtrl'
                     })*/
                    .otherwise({redirectTo: '/'});
        })
        .controller('main', function ($scope) {                     //Main Controller (mainly used For Caching)
            $scope.banner = {};
            $scope.fetchedatoz = [];
            $scope.fetchedbyyear = [];
            $scope.banner.visibility = true;
        })
        .controller('mp3Ctrl', function ($scope, $http) {                  //Not in Use and Left for Reference(Donot Remove)
            $scope.banner.visibility = true;
            $scope.message = "first";
           
                $http.get('ajax/movielist.php')
                        .then(function (response) {
                             $scope.listmovie = response.data[0];
                             console.log($scope.listmovie);
                        }); 
        })
        .controller('newCtrl', function ($scope,$http) {                  //Controller for New Releases
            $scope.banner.visibility = false;
            $scope.listlocationname = "A-Z MOVIE SONGS";
            $http.get("ajax/new.php")
                    .then(function(response){
                        $scope.list1 = response.data[0];
                        $scope.list2 = response.data[1];
            });
            
        })
        .controller('listCtrl', function ($scope, $routeParams, $http) {
            //Controller for Star Hits Template Page
            $scope.banner.visibility = false;
            var place = $routeParams.place;
            var col=1;

            if (place == "StarHits") {
                place = "Star Hits";
                $scope.listlocation = "StarHits";
                $scope.listlocationname = "STAR HITS";
                $scope.location = "star_images";
            } else if (place == "MusicDirectorHits") {
                place = "Music Director Hits";
                $scope.listlocation = "MusicDirectorHits";
                $scope.listlocationname = "MUSIC DIRECTOR HITS";
                $scope.location = "director_images";
            } else if (place == "SingerHits") {
                place = "Singer Hits";
                $scope.listlocation = "SingerHits";
                $scope.listlocationname = "SINGER HITS";
                $scope.location = "singer_images";
            }else if (place == "OldHits") {
                place = "Old Hits";
                $scope.listlocation = "OldHits";
                $scope.listlocationname = "OLD HITS";
                $scope.location = "old_images";
                col = 1;
            } if (place == "IlayarajaHits") {
                place = "Ilayaraja Hits";
                $scope.listlocation = "IlayarajaHits";
                $scope.listlocationname = "ILAYARAJA HITS";
                col=3;
            } else if (place == "ARRahmanHits") {
                place = "A R Rahman Hits";
                $scope.listlocation = "ARRahmanHits";
                $scope.listlocationname = "A R RAHMAN HITS";
                col=3;
            } else if (place == "OldCollections") {
                place = "Old Collections";
                $scope.listlocation = "OldCollections";
                $scope.listlocationname = "OLD COLLECTIONS";
                col=3;
            }else if (place == "Ringtones") {
                place = "Ringtones";
                $scope.listlocation = "Ringtones";
                $scope.listlocationname = "RING TONES";
                col=2;
            }

            /*
             * @var listlocation = Store the Tag Value  
             * @var listlocationname = To be displayed on top
             * @var location = The location of Images
             * @var col = for specifying number of columns the data to be displayed in
             */

            $http.post('ajax/list.php', {
                loc: "../FileSystem/" + place + "/",               //Location of Folder
                col: col
            })
                    .then(function (response) {
                        if(col==1){
                        $scope.list = response.data[0];
                        } else if(col==2){
                            $scope.list1 = response.data[0];
                            $scope.list2 = response.data[1];
                        } else if(col==3){
                            $scope.list1 = response.data[0];
                            $scope.list2 = response.data[1];
                            $scope.list3 = response.data[2];
                        } 
                });        
        })
        .controller('azList', function ($scope, $routeParams, $http) {      //Controller for A-Z Movie Listing Template Page
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
            var place = $routeParams.place;

            if (place == "azlisting") {                                   //Location of Folder by Condition
                place = "A-Z Movie Songs";
            } else if (place == "StarHits") {
                place = "Star Hits";
            } else if (place == "MusicDirectorHits") {
                place = "Music Director Hits";
            } else if (place == "SingerHits") {
                place = "Singer Hits";
            } else if (place == "IlayarajaHits") {
                place = "Ilayaraja Hits";
            } else if (place == "ARRahmanHits") {
                place = "A R Rahman Hits";
            }else if (place == "OldHits") {
                place = "Old Hits";                
            }else if (place == "Ringtones") {
                place = "Ringtones";                
            }

            var name = $routeParams.name;
            $http.post('ajax/songlist.php', {
                loc: '../FileSystem/' + place + '/' + name + '/'                       //Album location
            })
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


