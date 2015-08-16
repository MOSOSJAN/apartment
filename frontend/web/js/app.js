'use strict';

var app = angular.module('app', [
    'ngRoute',      //$routeProvider
    'mgcrea.ngStrap',//bs-navbar, data-match-route directives
    'ngResource'
]);



app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', {
                templateUrl: 'views/index.html',
                controller:'HomeCtrl'
            }).
            when('/about', {
                templateUrl: 'views/about.html'
            }).
            when('/contact', {
                templateUrl: 'views/contact.html'
            }).
            when('/login', {
                templateUrl: 'views/login.html'
            })
            .when('/posts', {
                templateUrl: 'views/posts.html',
                controller:'PostCtrl'
            }).
            when('/post/:postId', {
                templateUrl: 'views/postdetail.html',
                controller:'DetailCtrl'
            }).
            otherwise({
                templateUrl: '/'
            });
    }
]);

/* Factory*/
app.factory('Posts',[
    '$resource',function($resource){
        return $resource('index.php?r=site/:phoneId',{
            phoneId: 'phones',
            //format: 'json'
        })
    }
])
app.value('SITE_URL', 'http://apartment/frontend/web/');



app.controller('PostCtrl',['$scope','$http','$location','Posts',function($scope,$http,$location,Posts){
    Posts.query({phoneId: 'posts'},function(data){
        $scope.posts = data;
    });
}]);

app.controller('DetailCtrl',['$scope','$http','$location','$routeParams','Posts',function($scope,$http,$location,$routeParams,Posts){

    console.log($routeParams.postId);
    Posts.get({phoneId: 'post&id='+$routeParams.postId},function(data){
        $scope.post = data;
    });
}]);


