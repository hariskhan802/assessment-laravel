<!DOCTYPE html>
<html ng-app="my-app">
<head>
	<title>Films</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/1.0.30/angular-ui-router.min.js" integrity="sha512-HdDqpFK+5KwK5gZTuViiNt6aw/dBc3d0pUArax73z0fYN8UXiSozGNTo3MFx4pwbBPldf5gaMUq/EqposBQyWQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/1.0.30/stateEvents.js" integrity="sha512-FdN8ohZzlFeaVCSdC5pY/B6ELSeUHXtcQ6eVqdBqI7+mOo36yg8lThxAkCEiMtaRFur5nr8ChBPZiYhQBnsFIw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<base href="/assessment-laravel/public/">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<style type="text/css">
		.error-msg{
			color: red;
		}
	</style>
</head>
<body ng-controller="filmController" ng-init="checkUserLoggedIn()">
	<div class="container">
		<nav class="navbar navbar-default"  ng-include="'templates/layout/nav.html'">
			
		</nav>

		<ui-view></ui-view>
	</div>
	<script type="text/javascript">
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
			
			$scope.baseURL = '{{ url('') }}';
			$scope.success = '';
			$scope.error = '';
			
			$scope.fetchFilms = function(page = 1){
				$http.get('{{ route("films")."?page=" }}'+page).success(function(response){
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
			 		url: "{{route('films.create')}}",
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
				$http.get('{{ route("get-countries") }}').success(function(response){
					$scope.countries = response.data;
				});
			}
			$scope.getGenres = function() {
				$http.get('{{ route("get-genres") }}').success(function(response){
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
			 		url: "{{route('register')}}",
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
			 		url: "{{route('login')}}",
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
				$http.get('{{ route("logout") }}', {
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
			 		url: "{{route('post-comment')}}",
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
	</script>
</body>
</html>