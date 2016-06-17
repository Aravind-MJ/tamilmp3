var app = angular.module('tamilMp3', ['ngRoute', 'ezfb'])
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
        .filter('removeSpaces', [function () {
                return function (string) {
                    if (!angular.isString(string)) {
                        return string;
                    }
                    return string.replace(/[\s]/g, '');
                };
            }])
        .filter('trust', [
            '$sce',
            function ($sce) {
                return function (value, type) {
                    // Defaults to treating trusted text as `html`
                    return $sce.trustAs(type || 'html', value);
                }
            }
        ])
        .filter('orderObjectBy', function () {
            return function (items, field, reverse) {
                var filtered = [];
                angular.forEach(items, function (item) {
                    filtered.push(item);
                });
                filtered.sort(function (a, b) {
                    return (a[field] > b[field] ? 1 : -1);
                });
                if (reverse) {
                    filtered.reverse();
                }
                return filtered;
            };
        })
        .config(function (ezfbProvider) {                                               //Configuration for facebook Integration
            ezfbProvider.setInitParams({
                appId: '1121767971198398'                                               //Facebook App Id
            });
        })
        .config(function ($routeProvider, $locationProvider) {                         //Following are the Routing Condition to Different Templates
            $routeProvider
                    .when("/", {//Index Page
                        templateUrl: 'template/initial.php',
                        controller: 'mp3Ctrl'
                    })
                    .when("/Search/:searchTerm", {//Index Page
                        templateUrl: 'template/result.php',
                        controller: 'searchCtrl'
                    })
                    .when("/azlisting/:place/:alpha", {//A-Z Movie Listing
                        templateUrl: 'template/az.php',
                        controller: 'azList'
                    })
                    .when("/Album/:place/:name", {//Album Page
                        templateUrl: 'template/album.php',
                        controller: 'albumCtrl'
                    })
                    .when("/List/:place", {//List Common Page
                        templateUrl: 'template/3col.php',
                        controller: 'listCtrl'
                    })
                    .when("/NewReleases", {//New Releases Page
                        templateUrl: 'template/2col.php',
                        controller: 'txtCtrl'
                    })
                    .when("/:place", {//Hits Common Page
                        templateUrl: 'template/hits.php',
                        controller: 'listCtrl'
                    })
                    .when("/Category/:place", {//List Category Page
                        templateUrl: 'template/starlist.php',
                        controller: 'starCtrl'
                    })
                    .when("/:place/:name", {//List StarMovie Page
                        templateUrl: 'template/2col.php',
                        controller: 'movieCtrl'
                    })
                    .when("/List/Year/byyear", {//Year Listing Page
                        templateUrl: 'template/byyear.php',
                        controller: 'yearCtrl'
                    })
                    .when("/Movie/:place/:name", {//Year Inner Page
                        templateUrl: 'template/byyearlist.php',
                        controller: 'yearlistCtrl'
                    })
                    .otherwise({redirectTo: ''});

            $locationProvider.html5Mode(true);
        })
        .controller('main', function ($scope, $location, $http, $window) {                     //Main Controller (mainly used For Caching)
            $scope.banner = {};
            $scope.breadcrumbs = {};
            $scope.breadcrumbs.path = '';
            $scope.searchTerm = {};
            $scope.searchTerm.text = '';
            $scope.banner.visibility = true;

            $scope.OgTags = {};
            $scope.OgTags.url = 'demox.imrokraft.com/tamilmp3';
            $scope.OgTags.type = 'website';
            $scope.OgTags.title = 'One Stop for all your Songs';
            $scope.OgTags.description = 'Find your songs right here';
            $scope.OgTags.image = 'https://www.demox.imrokraft.com/tamilmp3/images/friends-tamil-mp3-banner2.jpg';

            $scope.socialShare = function (type) {
                var url = '';
                if (type == "facebook") {
                    url = '//www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent($scope.OgTags.url);
                } else if(type == "twitter"){
                    url = '//twitter.com/intent/tweet?text=Tamil%20MP3&amp;url=' + encodeURIComponent($scope.OgTags.url);
                } else if (type == "googleplus"){
                    url = '//plus.google.com/share?url=' + encodeURIComponent($scope.OgTags.url);
                } else {
                    return false;
                }
                window.open(url, '_blank', 'scrollbars=0, resizable=1, menubar=0, left=100, top=100, width=550, height=440, toolbar=0, status=0');
            };

            $scope.albumSearch = function () {
                if ($scope.searchTerm.text == '' || $scope.searchTerm.text == undefined) {

                    $('.searchText').on("mouseenter", function (e) {
                        e.stopImmediatePropagation();
                    });

                    $('.searchText').tooltip({items: '.searchText', content: '<center>Search Term Required.<br> Only Alphabets and Numbers allowed</center>'});
                    $('.searchText').tooltip('open');

                    $(document).mouseup(function () {
                        $('.searchText').tooltip('close');
                    });
                } else {
                    var search = $scope.searchTerm.text;
                    $location.path('/Search/' + search);
                }
            };

            $scope.checkEnter = function ($event) {
                var keycode = $event.which || $event.keyCode;
                if (keycode == 13) {
                    $scope.albumSearch();
                }
            };

            $http.post('ajax/list.php', {
                loc: "../FileSystem/Others/", //Location of Folder
                col: 1
            })
                    .then(function (response) {
                        $scope.otherslist = response.data[0];
                    });

            $http.get('ajax/banner_news.php')
                    .then(function (response) {
                        $scope.bannerlist = response.data[0];
                        $scope.newslist = response.data[1];
                    });
        })
        .controller('mp3Ctrl', function ($scope, $http) {
            $scope.breadcrumbs.path = '';
            $scope.banner.visibility = true;
            $scope.message = "first";

            $http.get('ajax/movielist.php')
                    .then(function (response) {
                        $scope.listmovie = response.data[0];
//                        console.log($scope.listmovie);
                    });

            $http.get('ajax/top_collections.php')
                    .then(function (response) {
                        $scope.listtc = response.data;
//                        console.log($scope.listmovie);
                    });

            $http.get('ajax/popular_downloads.php')
                    .then(function (response) {
                        $scope.listpd = response.data;
//                        console.log($scope.listmovie);
                    });
        })
        .controller('searchCtrl', function ($scope, $http, $routeParams, $sce) {
            $scope.breadcrumbs.path = $sce.trustAsHtml("<a href='/tamilmp3'>Home</a> > Search > " + $routeParams.searchTerm);
            $scope.banner.visibility = false;
            $scope.listlocationname = "Search Result";
            $scope.tab = true;
            $scope.noalbum = false;
            $scope.nosong = false;
            $scope.pagination = {};
            var term = $routeParams.searchTerm;
            $http.post("ajax/search.php", {
                search: term
            }).then(function (response) {
                if (response.data[0].length < 1) {
                    $scope.tab = false;
                    $scope.noalbum = true;
                }

                if (response.data[1].length < 1) {
                    $scope.nosong = true;
                }
                $scope.result = response.data[0];
                $scope.songs = response.data[1];

                $scope.pagination.albumpage = 0;
                $scope.pagination.albumlimit = response.data[0].length;
                $scope.pagination.songpage = 0;
                $scope.pagination.songlimit = response.data[1].length;

            });

            $scope.check = function (index, type) {
                if (type == 'album') {
                    var start = $scope.pagination.albumpage;
                    if (index >= start && index <= start + 2) {
                        return true;
                    }
                    return false;
                } else if (type = 'song') {
                    var start = $scope.pagination.songpage;
                    if (index >= start && index <= start + 2) {
                        return true;
                    }
                    return false;
                }
            }

            $scope.next = function (type) {
                if (type == 'album') {
                    var current = $scope.pagination.albumpage;
                    var limit = $scope.pagination.albumlimit;

                    if (current + 3 >= limit) {
//                        current = limit - 3;
                    } else {
                        current = current + 3;
                    }

                    $scope.pagination.albumpage = current;
                } else if (type = 'song') {
                    var current = $scope.pagination.songpage;
                    var limit = $scope.pagination.songlimit;

                    if (current + 3 >= limit) {
//                        current = limit - 3;
                    } else {
                        current = current + 3;
                    }

                    $scope.pagination.songpage = current;
                }
            }

            $scope.prev = function (type) {
                if (type == 'album') {
                    var current = $scope.pagination.albumpage;

                    if (current <= 3) {
                        current = 0;
                    } else {
                        current = current - 3;
                    }

                    $scope.pagination.albumpage = current;
                } else if (type == 'song') {
                    var current = $scope.pagination.songpage;

                    if (current <= 3) {
                        current = 0;
                    } else {
                        current = current - 3;
                    }

                    $scope.pagination.songpage = current;
                }
            }

            $scope.pageOf = function (type) {
                if (type == 'album') {
                    return "Page " + Math.ceil($scope.pagination.albumpage / 3 + 1) + " of " + Math.ceil($scope.pagination.albumlimit / 3);
                } else if (type == 'song') {
                    return "Page " + Math.ceil($scope.pagination.songpage / 3 + 1) + " of " + Math.ceil($scope.pagination.songlimit / 3);
                }
            }
        })
        .controller('txtCtrl', function ($scope, $http, $location, $sce) {                  //Controller for New Releases
            $scope.banner.visibility = false;
            var tag = $location.url();
            if (tag == "/NewReleases") {
                $scope.breadcrumbs.path = $sce.trustAsHtml("<a href='/tamilmp3'>Home</a> > New Releases");
                $scope.listlocation = "NewReleases";
                $scope.listlocationname = "NEW RELEASES";
                file = "newreleases.txt";
                col = 2;


                $http.get('ajax/top_collections.php')
                        .then(function (response) {
                            $scope.listtc = response.data;
//                        console.log($scope.listmovie);
                        });

                $http.get('ajax/popular_downloads.php')
                        .then(function (response) {
                            $scope.listpd = response.data;
//                        console.log($scope.listmovie);
                        });
            }

            $http.post("ajax/read.php", {
                file: "../text_files/" + file,
                col: col
            })
                    .then(function (response) {
                        if (col == 2) {
                            $scope.list1 = response.data[0];
                            $scope.list2 = response.data[1];
                        } else if (col == 3) {
                            $scope.list1 = response.data[0];
                            $scope.list2 = response.data[1];
                            $scope.list3 = response.data[2];
                        }
                    });

        })
        .controller('listCtrl', function ($scope, $routeParams, $http, $sce, $location) {
            //Controller for Star Hits Template Page
            $scope.banner.visibility = false;
            var place = $routeParams.place;
            var col = 1;

            if (place == "StarHits") {
                place = "Star Hits";
                $scope.breadcrumbs.path = $sce.trustAsHtml("<a href='/tamilmp3'>Home</a> > Star Hits");
                $scope.listlocation = "StarHits";
                $scope.listlocationname = "STAR HITS";
                $scope.location = "images/star_images";
            } else if (place == "MusicDirectorHits") {
                place = "Music Director Hits";
                $scope.breadcrumbs.path = $sce.trustAsHtml("<a href='/tamilmp3'>Home</a> > Music Director Hits");
                $scope.listlocation = "MusicDirectorHits";
                $scope.listlocationname = "MUSIC DIRECTOR HITS";
                $scope.location = "images/director_images";
            } else if (place == "SingerHits") {
                place = "Singer Hits";
                $scope.breadcrumbs.path = $sce.trustAsHtml("<a href='/tamilmp3'>Home</a> > Singer Hits");
                $scope.listlocation = "SingerHits";
                $scope.listlocationname = "SINGER HITS";
                $scope.location = "images/singer_images";
            } else if (place == "OldHits") {
                place = "Old Hits";
                $scope.breadcrumbs.path = $sce.trustAsHtml("<a href='/tamilmp3'>Home</a> > Old Hits");
                $scope.listlocation = "OldHits";
                $scope.listlocationname = "OLD HITS";
                $scope.location = "images/singer_images";
            } else if (place == "ARRahmanHits") {
                place = "A R Rahman Hits";
                $scope.breadcrumbs.path = $sce.trustAsHtml("<a href='/tamilmp3'>Home</a> > A R Rahman Hits");
                $scope.listlocation = "ARRahmanHits";
                $scope.listlocationname = "A R RAHMAN HITS";
                col = 3;
            } else if (place == "OldCollections") {
                place = "Old Collections";
                $scope.breadcrumbs.path = $sce.trustAsHtml("<a href='/tamilmp3'>Home</a> > Old Collections");
                $scope.listlocation = "OldCollections";
                $scope.listlocationname = "OLD COLLECTIONS";
                col = 3;
            } else if (place == "Ringtones") {
                place = "Ringtones";
                $scope.breadcrumbs.path = $sce.trustAsHtml("<a href='/tamilmp3'>Home</a> > Ringtones");
                $scope.listlocation = "Ringtones";
                $scope.listlocationname = "RING TONES";
                col = 2;
            } else if (place == "BGMCollections") {
                place = "BGM Collections";
                $scope.breadcrumbs.path = $sce.trustAsHtml("<a href='/tamilmp3'>Home</a> > BGM Collections");
                $scope.listlocation = "BGMCollections";
                $scope.listlocationname = "BGM COLLECTIONS";
                col = 2;
            } else if (place == "DevotionalCollections") {
                place = "Devotional Collections";
                $scope.breadcrumbs.path = $sce.trustAsHtml("<a href='/tamilmp3'>Home</a> > Devotional Collections");
                $scope.listlocation = "DevotionalCollections";
                $scope.listlocationname = "DEVOTIONAL COLLECTIONS";
                col = 3;
            } else if (place == "HinduCollections") {
                place = "Devotional Collections/Hindu Collections";
                $scope.breadcrumbs.path = $sce.trustAsHtml("<a href='/tamilmp3'>Home</a> > <a href='List/DevotionalCollections'>Devotional Collections</a> > Hindu Collections");
                $scope.listlocation = "HinduCollections";
                $scope.listlocationname = "HINDU COLLECTIONS";
                $scope.location = "images/hindu_collection_images";
            } else if (place == "ChristianCollections") {
                place = "Devotional Collections/Christian Collections";
                $scope.breadcrumbs.path = $sce.trustAsHtml("<a href='/tamilmp3'>Home</a> > <a href='List/DevotionalCollections'>Devotional Collections</a> > Christian Collections");
                $scope.listlocation = "ChristianCollections";
                $scope.listlocationname = "CHRISTIAN COLLECTIONS";
                $scope.location = "images/christian_collection_images";
            } else if (place == "IslamicCollections") {
                place = "Devotional Collections/Islamic Collections";
                $scope.breadcrumbs.path = $sce.trustAsHtml("<a href='/tamilmp3'>Home</a> > <a href='List/DevotionalCollections'>Devotional Collections</a> > Islamic Collections");
                $scope.listlocation = "IslamicCollections";
                $scope.listlocationname = "ISLAMIC COLLECTIONS";
                $scope.location = "images/islamic_collection_images";
            } else if (place == "AlbumSongs") {
                place = "Album Songs";
                $scope.breadcrumbs.path = $sce.trustAsHtml("<a href='/tamilmp3'>Home</a> > Album Songs");
                $scope.listlocation = "AlbumSongs";
                $scope.listlocationname = "ALBUM SONGS";
                col = 2;
            } else if (place == "RemixCollections") {
                place = "Remix Collections";
                $scope.breadcrumbs.path = $sce.trustAsHtml("<a href='/tamilmp3'>Home</a> > Remix Collections");
                $scope.listlocation = "RemixCollections";
                $scope.listlocationname = "REMIX COLLECTIONS";
                col = 2;
            } else if (place == "SpecialCollections") {
                place = "Special Collections";
                $scope.breadcrumbs.path = $sce.trustAsHtml("<a href='/tamilmp3'>Home</a> > Special Collections");
                $scope.listlocation = "SpecialCollections";
                $scope.listlocationname = "SPECIAL COLLECTIONS";
                col = 2;
            } else if (place == "ComedyDramas") {
                place = "Comedy Dramas";
                $scope.breadcrumbs.path = $sce.trustAsHtml("<a href='/tamilmp3'>Home</a> > Comedy Dramas");
                $scope.listlocation = "ComedyDramas";
                $scope.listlocationname = "COMEDY DRAMAS";
                $scope.location = "images/comedy_drama_images";
            } else {

                if (place == "ILayaraja Movies") {
                    $location.path('/azlisting/ILayarajaMovies/A');
                }

                $scope.breadcrumbs.path = $sce.trustAsHtml("<a href='/tamilmp3'>Home</a> > " + place);
                $scope.listlocation = place;
                $scope.listlocationname = place;
                col = 3;
            }

            /*
             * @var listlocation = Store the Tag Value
             * @var listlocationname = To be displayed on top
             * @var location = The location of Images
             * @var col = for specifying number of columns the data to be displayed in
             */

            $http.post('ajax/list.php', {
                loc: "../FileSystem/" + place + "/", //Location of Folder
                col: col
            })
                    .then(function (response) {
                        if (col == 1) {
                            $scope.list = response.data[0];
                        } else if (col == 2) {
                            $scope.list1 = response.data[0];
                            $scope.list2 = response.data[1];
                        } else if (col == 3) {
                            $scope.list1 = response.data[0];
                            $scope.list2 = response.data[1];
                            $scope.list3 = response.data[2];
                        }
                    });
        })
        .controller('azList', function ($scope, $routeParams, $http, $sce) {      //Controller for A-Z Movie Listing Template Page
            $scope.banner.visibility = false;
            $scope.indexChar = function (index) {
                return String.fromCharCode(65 + index);
            };
            $scope.getTimes = function (n) {
                return new Array(n);
            };
            $scope.renameLocation = function (listlocation, listlocationname) {
                if (listlocationname == "M.S.VISWANATHAN HITS") {
                    return "MSViswanathanHits";
                }
                return listlocation;
            };
            $scope.currentAlpha = function(char){
                var term = $routeParams.alpha;
                if(term == char){
                    return true;
                }
                return false;
            };
            var place = $routeParams.place;
            var alpha = $routeParams.alpha;
            var file = false;
            if (place == "A-ZMovieSongs") {
                track = place;
                place = "A-Z Movie Songs";
                $scope.breadcrumbs.path = $sce.trustAsHtml("<a href='/tamilmp3'>Home</a> > <a href='azlisting/" + track + "/A'>" + place + "</a> > " + alpha);
                place = "../FileSystem/" + place + "/";
                $scope.listlocation = "A-ZMovieSongs";
                $scope.listlocationname = "A-Z MOVIE LIST";
            } else if (place == "ILayarajaMovies") {
                track = place;
                place = "ILayaraja Movies";
                $scope.breadcrumbs.path = $sce.trustAsHtml("<a href='/tamilmp3'>Home</a> > <a href='azlisting/" + track + "/A'>" + place + "</a> > " + alpha);
                place = "../FileSystem/" + place + "/";
                $scope.listlocation = "ILayarajaMovies";
                $scope.listlocationname = "ILAYARAJA MOVIES";
            } else if (place == "TamilKaraoke") {
                track = place;
                place = "Tamil Karaoke";
                $scope.breadcrumbs.path = $sce.trustAsHtml("<a href='/tamilmp3'>Home</a> > <a href='azlisting/" + track + "/A'>" + place + "</a> > " + alpha);
                place = "../FileSystem/" + place + "/";
                $scope.listlocation = "TamilKaraoke";
                $scope.listlocationname = "TAMIL KARAOKE";
            } else if (place == "MSViswanathanHits") {
                $scope.breadcrumbs.path = $sce.trustAsHtml("<a href='/tamilmp3'>Home</a> > <a href='azlisting/" + place + "/A'>M S Viswanathan Hits</a> > " + alpha);
                place = "../text_files/M.S.Viswanathan Hits.txt";
                $scope.listlocation = "A-ZMovieSongs";
                $scope.listlocationname = "M.S.VISWANATHAN HITS";
                file = true;
            }
            $http.post('ajax/azlist.php', {
                loc: place, //Location of Folder
                alpha: alpha,
                file: file
            })
                    .then(function (response) {
                        $scope.list1 = response.data[0];
                        $scope.list2 = response.data[1];
                        $scope.list3 = response.data[2];
                    });
        })
        .controller('albumCtrl', function ($scope, $routeParams, $http, $filter, $sce) {
            $scope.banner.visibility = false;
            $scope.selected = [];
            $scope.name = $routeParams.name;

            var place = $routeParams.place;
            var name = $routeParams.name;
            var track = '';

            if (place == "A-ZMovieSongs") {                                   //Location of Folder by Condition
                place = "A-Z Movie Songs";
                track = $sce.trustAsHtml("> <a href='azlisting/A-ZMovieSongs/A'>" + place + "</a> >");
            } else if (place == "StarHits") {
                place = "Star Hits";
                track = $sce.trustAsHtml("> <a href='StarHits'>" + place + "</a> >");
            } else if (place == "MusicDirectorHits") {
                place = "Music Director Hits";
                track = $sce.trustAsHtml("> <a href='MusicDirectorHits'>" + place + "</a> >");
            } else if (place == "SingerHits") {
                place = "Singer Hits";
                track = $sce.trustAsHtml("> <a href='SingerHits'>" + place + "</a> >");
            } else if (place == "ILayarajaMovies") {
                place = "ILayaraja Movies";
                track = $sce.trustAsHtml("> <a href='azlisting/ILayarajaMovies/A'>" + place + "</a> >");
            } else if (place == "ARRahmanHits") {
                place = "A R Rahman Hits";
                track = $sce.trustAsHtml("> <a href='List/ARRahmanHits'>" + place + "</a> >");
            } else if (place == "OldHits") {
                place = "Old Hits";
                track = $sce.trustAsHtml("> <a href='OldHits'>" + place + "</a> >");
            } else if (place == "Ringtones") {
                place = "Ringtones";
                track = $sce.trustAsHtml("> <a href='List/Ringtones'>" + place + "</a> >");
            } else if (place == "TamilKaraoke") {
                place = "Tamil Karaoke";
                track = $sce.trustAsHtml("> <a href='azlisting/TamilKaraoke/A'>" + place + "</a> >");
            } else if (place == "BGMCollections") {
                place = "BGM Collections";
                track = $sce.trustAsHtml("> <a href='List/BGMCollections'>" + place + "</a> >");
            } else if (place == "HinduCollections") {
                place = "Devotional Collections/Hindu Collections";
                track = $sce.trustAsHtml("> <a href='List/DevotionalCollections'>Devotional Collections</a> > <a href='HinduCollections'>Hindu Collections</a> >");
            } else if (place == "IslamicCollections") {
                place = "Devotional Collections/Islamic Collections";
                track = $sce.trustAsHtml("> <a href='List/DevotionalCollections'>Devotional Collections</a> > <a href='IslamicCollections'>Islamic Collections</a> >");
            } else if (place == "ChristianCollections") {
                place = "Devotional Collections/Christian Collections";
                track = $sce.trustAsHtml("> <a href='List/DevotionalCollections'>Devotional Collections</a> > <a href='ChristianCollections'>Christian Collections</a> >");
            } else if (place == "AlbumSongs") {
                place = "Album Songs";
                track = $sce.trustAsHtml("> <a href='List/AlbumSongs'>" + place + "</a> >");
            } else if (place == "RemixCollections") {
                place = "Remix Collections";
                track = $sce.trustAsHtml("> <a href='List/RemixCollections'>" + place + "</a> >");
            } else if (place == "SpecialCollections") {
                place = "Special Collections";
                track = $sce.trustAsHtml("> <a href='List/SpecialCollections'>" + place + "</a> >");
            } else if (place == "OldCollections") {
                place = "Old Collections";
                track = $sce.trustAsHtml("> <a href='List/OldCollections'>" + place + "</a> >");
            } else if (place == "ComedyDramas") {
                place = "Comedy Dramas";
                track = $sce.trustAsHtml("> <a href='ComedyDramas'>" + place + "</a> >");
            } else if (place == "Others") {

                angular.forEach($scope.otherslist, function (value, key) {
                    namec = $filter('removeSpaces')(value.name);
                    if (namec == name) {
                        name = value.name;
                    }
                });

                track = ">";

            } else {
                namec = $filter('removeSpaces')(place);
                track = $sce.trustAsHtml("> <a href='" + namec + "'>" + place + "</a> >");
            }

            $scope.breadcrumbs.path = $sce.trustAsHtml("<a href='/tamilmp3'>Home</a> " + track + " " + name);
            $scope.place = place;
            $http.post('ajax/songlist.php', {
                loc: '../FileSystem/' + place + '/' + name + '/', //Album location
                col: 1
            }).then(function (response) {
                $scope.list = response.data;
                $scope.detail = response.data.detail;
                $scope.moviedetails = response.data.moviedetails;
            });


            $("#jquery_jplayer_1").jPlayer({
                ready: function (event) {
                    $(this).jPlayer("setMedia", {});
                },
                swfPath: "/plugin/jplayer/dist/jplayer",
                supplied: "mp3",
                wmode: "window",
                preload: "auto",
                useStateClassSkin: true,
                autoBlur: false,
                smoothPlayBar: true,
                keyEnabled: true,
                remainingDuration: true,
                toggleDuration: true
            }).jPlayer("play");

            var playlist = [];
            var dummy_list_arr = new Array();

            var cssSelector = {jPlayer: "#jquery_jplayer_1", cssSelectorAncestor: "#jp_container_1"};
            var options = {swfPath: "/plugin/jplayer/dist/jplayer", playlistOptions: {
                    enableRemoveControls: true
                }, supplied: "mp3", smoothPlayBar: true, keyEnabled: true, audioFullScreen: true};
            var myPlaylist = new jPlayerPlaylist(cssSelector, playlist, options);

            $scope.place = place;
            $http.post('ajax/songlist.php', {
                loc: '../FileSystem/' + place + '/' + name + '/', //Album location
                col: 1
            }).then(function (response) {
                $scope.list = response.data;
                $scope.detail = response.data.detail;
                $scope.moviedetails = response.data.moviedetails;
                var sngCnt = 0;

                $.each(response.data.song, function (index, val) {
                    if (sngCnt == 0) {
                        myPlaylist.add({title: val.name, mp3: val.downpath});
                        dummy_list_arr.push(val.name);
                    }

                    sngCnt++
                })

            });

            var playlisted_arr = [];
            $scope.playSong = function (path, songname, index, action) {
                $scope.playershow = false;

                if (action == 'play') {
                    //song_list_arr = [];
                    //myPlaylist = player(song_list_arr);
                    console.log(songname);
                    if ($.inArray(songname, dummy_list_arr) !== -1) {
                        console.log('in the playlist');
                        var indexi = dummy_list_arr.indexOf(songname);
                    } else {
                        if ($.inArray(songname, playlisted_arr) == -1) {
                            console.log('added and play');
                            dummy_list_arr.push(songname);
                            //myPlaylist.add({title: songname, mp3: path});
                            var indexi = dummy_list_arr.indexOf(songname);

                        }
                    }
                    myPlaylist.play(indexi);

                } else {

                    if ($.inArray(songname, dummy_list_arr) == -1) {
                        myPlaylist.add({title: songname, mp3: path});
                        dummy_list_arr.push(songname);
                        playlisted_arr.push(songname);
                    }
                }

            }


            $scope.checkAll = function () {
                if ($scope.checkall)
                    checkUnchcek(true);
                else
                    checkUnchcek(false);
            }

            function checkUnchcek(boolean) {
                angular.forEach($scope.list.song, function (songselected) {
                    songselected.selected = boolean;
                });
            }

            $scope.playCurrentSong = function () {
                //console.log(dummy_list_arr);
                //console.log($scope.list.song);
                var v = 0;
                angular.forEach($scope.list.song, function (songselected, index) {
                    if (songselected.selected === true) {

                        if ($.inArray(songselected.name, dummy_list_arr) == -1) {
                            myPlaylist.add({title: songselected.name, mp3: songselected.downpath});
                            dummy_list_arr.push(songselected.name);
                        }


                    } else {

                        if ($.inArray(songselected.name, dummy_list_arr) !== -1) {

                            var indexi = dummy_list_arr.indexOf(songselected.name);

                            myPlaylist.option("removeTime", 0);
                            myPlaylist.remove(indexi);
                            dummy_list_arr.splice(indexi, 1);
                            console.log(dummy_list_arr);
                        }
                    }
                    v++;
                });
                myPlaylist.play(0);

            }

            $scope.addToPlaylist = function () {

                angular.forEach($scope.list.song, function (songselected, index) {

                    if (songselected.selected) {

                        if ($.inArray(songselected.name, dummy_list_arr) == -1) {
                            myPlaylist.add({title: songselected.name, mp3: songselected.downpath});
                            dummy_list_arr.push(songselected.name);
                        }
                    } /*else {
                     
                     if ($.inArray(songselected.name, dummy_list_arr) !== -1) {
                     var indexi = dummy_list_arr.indexOf(songselected.name);
                     
                     dummy_list_arr.splice(indexi, 1);
                     myPlaylist.option("removeTime", 0);
                     myPlaylist.remove(indexi);
                     }
                     }*/

                })


            }

            player = function (playlist) {
                var playlist = playlist;
                var cssSelector = {jPlayer: "#jquery_jplayer_1", cssSelectorAncestor: "#jp_container_1"};
                var options = {swfPath: "/plugin/jplayer/dist/jplayer", playlistOptions: {
                        enableRemoveControls: true
                    }, supplied: "mp3", smoothPlayBar: true, keyEnabled: true, audioFullScreen: true};
                var myPlaylist = new jPlayerPlaylist(cssSelector, playlist, options);
                return myPlaylist;
            }

            $(document).on('click', '.jp-playlist-item-remove', function () {
                // Determine song index if necessary
                var index = $(this).parents('li').index('.jp-playlist li');

                //song_list_arr.splice(index, 2);
                var mp3name = $(this).next().html();

                if ($.inArray(mp3name, dummy_list_arr) !== -1) {
                    var index = dummy_list_arr.indexOf(mp3name);

                    dummy_list_arr.splice(index, 1);
                    myPlaylist.remove(index);
                }

            });
        })


        .controller('starCtrl', function ($scope, $routeParams, $http, $sce) {                  //Controller for Star list n Music director list

            $scope.banner.visibility = false;
            var place = $routeParams.place;
            if (place == 'StarMovies') {
                $scope.breadcrumbs.path = $sce.trustAsHtml("<a href='/tamilmp3'>Home</a> > <a href='category/StarMovies'>Star Movies </a>");
                $scope.listlocation = "Star Movies";
                $scope.listlocationname = "STAR MOVIES";
                place = "Star Movies";

            } else if (place == 'MusicDirectorMovies') {
                $scope.breadcrumbs.path = $sce.trustAsHtml("<a href='/tamilmp3'>Home</a> > <a href='category/MusicDirectorMovies'>Music Director Movies</a>");
                $scope.listlocation = "Music Director Movies";
                $scope.listlocationname = "MUSIC DIRECTOR MOVIES";
                place = "Music Director Movies";

            }

            $http.post("ajax/readstar.php", {
                file: "../FileSystem/" + place
            })
                    .then(function (response) {
                        $scope.list1 = response.data[0];
                        $scope.list2 = response.data[1];
                    });

        })
        .controller('movieCtrl', function ($scope, $routeParams, $http, $sce) {                  //Controller for Star movies n Music director movies

            $scope.banner.visibility = false;
            $scope.name = $routeParams.name;
            var place = $routeParams.place;
            $scope.starname = "/" + $scope.name;

            if (place == "Star Movies") {
                $scope.breadcrumbs.path = $sce.trustAsHtml("<a href='/tamilmp3'>Home</a> > <a href='category/StarMovies'>Star Movies </a> > " + $scope.name);
                $scope.listlocation = "Star Movies";
                $scope.listlocationname = "STAR MOVIES";

            } else if (place == "Music Director Movies") {
                $scope.breadcrumbs.path = $sce.trustAsHtml("<a href='/tamilmp3'>Home</a> > <a href='category/MusicDirectorMovies'>Music Director Movies </a> > " + $scope.name);
                $scope.listlocation = "Music Director Movies";
                $scope.listlocationname = "MUSIC DIRECTOR MOVIES";

            }

            $http.post("ajax/read.php", {
                file: "../FileSystem/" + place + "/" + $scope.name + ".txt",
                col: 2
            })
                    .then(function (response) {
                        $scope.list1 = response.data[0];
                        $scope.list2 = response.data[1];
                    });

        })

        .controller('yearCtrl', function ($scope, $http, $sce) {                  //Controller for Year Listing
            $scope.breadcrumbs.path = $sce.trustAsHtml("<a href='/tamilmp3'>Home</a> > List By Year");
            $scope.banner.visibility = false;
            $http.post('ajax/yearlist.php', {
                loc: '../FileSystem/byyear/', //Year location
            }).then(function (response) {
                $scope.list1 = response.data[0];
                $scope.list2 = response.data[1];
                $scope.list3 = response.data[2];
                $scope.list4 = response.data[3];
            });
        })

        .controller('yearlistCtrl', function ($scope, $http, $routeParams, $sce) {                  //Controller For Year Listing Inner Page
            $scope.banner.visibility = false;
            $scope.name = $routeParams.name;
            $scope.breadcrumbs.path = $sce.trustAsHtml("<a href='/tamilmp3'>Home</a> > <a href='List/Year/byyear'>List By Year<a> > " + $scope.name);
            var place = $routeParams.place;
            $scope.listlocation = "A-ZMovieSongs";

            $http.post("ajax/read.php", {
                file: "../FileSystem/" + place + "/" + $scope.name + ".txt",
                col: 3
            })
                    .then(function (response) {
                        $scope.list1 = response.data[0];
                        $scope.list2 = response.data[1];
                        $scope.list3 = response.data[2];
                    });

        });
