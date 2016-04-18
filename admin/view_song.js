var app = angular
        .module("songApp", [])
        .controller('songCtrl', function ($scope, $http) {
            $scope.limit = 10;

            $http.post("get_song.php", {
             search: '',
             limit: 10,
             offset: 0
             }).then(function (response) {
             $scope.songs = response.data;
             });
             
            $scope.searchFn = function () {
                $http.post("get_song.php", {
                    search: $scope.search,
                    limit: $scope.limit,
                    offset: 0
                }).then(function (response) {
                    $scope.songs = response.data;
                });
            }

//            $scope.$watch('limit', function (newvalue, oldvalue) {
//                if (newvalue != oldvalue) {
//                    $http.post("get_song.php", {
//                        search: $scope.search,
//                        limit: $scope.limit,
//                        offset: 0
//                    }).then(function (response) {
//                        $scope.songs = response.data;
//                    });
//                }
//            });
        });