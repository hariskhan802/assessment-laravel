
var app = angular.module('my-app', ['ui.router', 'ui.router.state.events']);

app.config(function($stateProvider, $locationProvider, $urlRouterProvider) {
	
	$stateProvider
		.state('films', {
			url: '/films',
			templateUrl: 'templates/films.html',
			controller: 'filmController'
		})
		.state('films-create', {
			url: '/films/create',
			templateUrl: 'templates/films-create.html',
			controller: 'filmController'
		})
		.state('film-detail', {
			url: '/films/:slug',
			templateUrl: 'templates/film-detail.html',
			controller: 'filmController'
		})
		.state('register', {
			url: '/register',
			templateUrl: 'templates/register.html',
			controller: 'filmController'
		})
		.state('login', {
			url: '/login',
			templateUrl: 'templates/login.html',
			controller: 'filmController'
		});
	
	$locationProvider.html5Mode(true);
	$urlRouterProvider.when('/','/films');

});

app.controller('filmController', function($scope, $http, $stateParams, $timeout, $state, $window, $rootScope){
	
	$scope.baseURL = baseURL;
	$scope.success = '';
	$scope.error = '';
	
	$scope.fetchFilms = function(page = 1){
		$http.get($scope.baseURL+"/api/films?page="+page).success(function(response){
			$scope.curPage = page;
			$scope.films = response.data;
			$scope.totalPages = Array.from({length: response.data.total}, (_, i) => i + 1);

		});
	};

	$scope.createFilm = function() {
		var fd = new FormData();
		var filmData = $scope.film;
	 	angular.forEach(filmData, function(field, key){
	 		if(field)
 				fd.append(key, key == 'photo' ? field[0] : field);
	 	});
	 	$http({
	 		method: "POST",
	 		url: $scope.baseURL+"/api/films/create",
	 		data: fd,
	 		transformRequest: angular.identity,
	 		headers: {'Content-Type': undefined}
	 	}).then(function(response){
	 		if (response.data.status === true) {
	 			$scope.success = response.data.msg;
	 			$timeout(function(){
	 				$state.go('films');
	 			}, 1000);
	 		}
	 	}, function(errors){
	 		$scope.errors = errors.data.errors;
	 	});

	}
	
	$scope.getCounties = function() {
		$http.get($scope.baseURL+'/api/get-countries').success(function(response){
			$scope.countries = response.data;
		});
	}
	$scope.getGenres = function() {
		$http.get($scope.baseURL+'/api/get-genres').success(function(response){
			$scope.genres = response.data;
		});
	}
	$scope.filmDetail = function() {
		$http.get($scope.baseURL+'/api/films/'+$stateParams.slug).success(function(response){
			if(!response.data) {
				$state.go('films');
			}

			$scope.filmData = response.data;
		});

	}
	
	$scope.register = function() {
		
		var fd = new FormData();
		var userData = $scope.user;
	 	angular.forEach(userData, function(field, key){
	 		if(field)
 				fd.append(key, field);
	 	});
	 	$scope.success = '';
	 	$http({
	 		method: "POST",
	 		url: $scope.baseURL+"/api/register",
	 		data: fd,
	 		transformRequest: angular.identity,
	 		headers: {'Content-Type': undefined}
	 	}).then(function(response){
	 		if (response.data.status === true) {
	 			$scope.success = response.data.msg;
	 			$scope.user = '';
	 			$window.sessionStorage.setItem('user_token', response.data.token);
	 			$window.sessionStorage.setItem('user', JSON.stringify(response.data.user));
	 			$timeout(function() {
	 				$state.go('films');
	 			}, 1000)
	 		}
	 	}, function(errors){
	 		$scope.errors = errors.data.errors;
	 	});
	}
	$scope.login = function() {
		
		var fd = new FormData();
		var userData = $scope.user;
	 	angular.forEach(userData, function(field, key){
	 		if(field)
 				fd.append(key, field);
	 	});
	 	$scope.success = '';
	 	$scope.error = '';
	 	$http({
	 		method: "POST",
	 		url: $scope.baseURL+"/api/login",
	 		data: fd,
	 		transformRequest: angular.identity,
	 		headers: {'Content-Type': undefined}
	 	}).then(function(response){
	 		if (response.data.status === true) {
	 			$scope.success = response.data.msg;
	 			$scope.user = '';
	 			$window.sessionStorage.setItem('user_token', response.data.token);
	 			$window.sessionStorage.setItem('user', JSON.stringify(response.data.user));
	 			$timeout(function() {
	 				$state.go('films');
	 			}, 1000)
	 		}
	 	}, function(errors){
	 		$scope.error = errors.data.msg;
	 	});
	}
	$scope.logout = function() {
		$http.get($scope.baseURL+"/api/logout", {
		    headers: {'Authorization': 'Bearer '+$scope.user_token}
		}).success(function(data){
			if (data.status === true) {
				$window.sessionStorage.setItem('user_token', '');
				$window.sessionStorage.setItem('user', '');
			}
		}).error(function(data){
			if (data.message == "Unauthenticated.") {
				$window.sessionStorage.setItem('user_token', '');
				$window.sessionStorage.setItem('user', '');
			}
		});
	}
	$scope.commentw = {};
	$scope.postComment = function(filmID, userID) {
		
		var fd = new FormData();
		var comment = $scope.commentw;
	 	angular.forEach(comment, function(field, key){
	 		if(field)
 				fd.append(key, field);
	 	});
	 	fd.append('film_id', filmID);
	 	fd.append('user_id', userID);

	 	$scope.success = '';
	 	$scope.error = '';
	 	$http({
	 		method: "POST",
	 		url: $scope.baseURL+"/api/post-comment",
	 		data: fd,
	 		transformRequest: angular.identity,
	 		headers: {'Content-Type': undefined, 'Authorization': 'Bearer '+$scope.user_token}
	 	}).then(function(response){
	 		if (response.data.status === true) {
	 			$scope.success = response.data.msg;
	 			$scope.commentw.comment = '';
	 			$scope.filmDetail();
	 		}
	 	}, function(response){
	 		$scope.error = response.data.errors.comment;
	 	});
	}
	$scope.checkUserLoggedIn = function() {
		$scope.user_token = $window.sessionStorage.getItem('user_token');
		$scope.user = $window.sessionStorage.getItem('user') ? JSON.parse($window.sessionStorage.getItem('user')) : '';
		return $scope.user_token != null && $scope.user_token != '';
	}
		// console.log($state);
	$rootScope.$on('$stateChangeStart', function (event, toState, toParams) {
		$scope.checkUserLoggedIn()
		// $state.go('films');
	});
});
app.directive("fileInput", function($parse){

	return{
		restrict : 'A',
		link: function(scope, elem, attrs){
			elem.bind("change", function(){
				$parse(attrs.fileInput).assign(scope, elem[0].files );
				scope.$apply();
			});
		}
	}


});