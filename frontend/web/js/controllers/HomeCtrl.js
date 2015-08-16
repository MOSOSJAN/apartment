app.controller('HomeCtrl',['$scope','$http', '$location','SITE_URL', function($scope, $http, $location,SITE_URL) {

    $scope.SITE_URL = SITE_URL;
    var img;

    $('.home-cats-inner').hover(function(){
        $(this).find('.hover-img').stop( true, true ).fadeIn(500);
        $(this).find('h2').css('color','#fff');
        $(this).find('p').css('color','#fff');
        var hover_img = $(this).find('.img-circle img').attr('data-img');
        img = $(this).find('.img-circle img').attr('src');
        $(this).find('.img-circle img').attr('src',hover_img);
        $(this).find('.img-circle').css('background','#182130');


    },function(){
        $(this).find('.hover-img').stop( true, true ).fadeOut(500);
        $(this).find('h2').css('color','#898989');
        $(this).find('p').css('color','#898989');
        $(this).find('.img-circle img').attr('src',img);
        $(this).find('.img-circle').css('background','none');


    });


}]);