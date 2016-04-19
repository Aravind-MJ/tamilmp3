var app = angular
        .module("songApp", [])
        .controller('songCtrl', function ($scope, $http) {
            $scope.limit = 10;
            $scope.search = '';
            $scope.offset = 0;

            $scope.$watch('limit', function (newvalue, oldvalue) {
                $http.post("get_song.php", {
                    search: $scope.search,
                    limit: $scope.limit,
                    offset: $scope.offset
                }).then(function (response) {
                    $scope.songs = response.data['songs'];
                    $scope.pagelimit = response.data['pagelimit'];
                    
                    if($scope.offset > $scope.pagelimit){
                        $scope.goto($scope.pagelimit-1);
                    }
                });



            });

            $scope.searchFn = function () {
                $http.post("get_song.php", {
                    search: $scope.search,
                    limit: $scope.limit,
                    offset: $scope.offset
                }).then(function (response) {
                    $scope.songs = response.data['songs'];
                    $scope.pagelimit = response.data['pagelimit'];
                });
            }

            $scope.next = function () {
                if ($scope.offset < $scope.pagelimit - 1) {
                    $scope.offset++;
                    $scope.searchFn();
                }
            }

            $scope.prev = function () {
                if ($scope.offset > 0) {
                    $scope.offset--;
                    $scope.searchFn();
                }
            }

            $scope.range = function (n) {
                return new Array(n);
            };

            $scope.goto = function (p) {
                $scope.offset = p;
                $scope.searchFn();
            }


        });