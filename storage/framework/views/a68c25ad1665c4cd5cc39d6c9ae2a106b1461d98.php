<!DOCTYPE html>
<html ng-app="my-app">
<head>
	<title>Films</title>
	<link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>" >
	<link rel="stylesheet" href="<?php echo e(asset('css/bootstrap-datepicker.min.css')); ?>" />

	
	<base href="/assessment-laravel/public/">
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<style type="text/css">
		.error-msg{
			color: red;
		}
	</style>
	<script type="text/javascript">
		var baseURL = "<?php echo e(url('')); ?>";
	</script>
</head>
<body ng-controller="filmController" ng-init="checkUserLoggedIn()">
	<div class="container">
		<nav class="navbar navbar-default"  ng-include="'templates/layout/nav.html'"></nav>

		<ui-view></ui-view>
	</div>

	<script src="<?php echo e(asset('js/jquery.min.js')); ?>" ></script>
	<script src="<?php echo e(asset('js/bootstrap-datepicker.min.js')); ?>" ></script>
	<script src="<?php echo e(asset('js/angular.min.js')); ?>"></script>
	<script src="<?php echo e(asset('js/angular-ui-router.min.js')); ?>"></script>
	<script src="<?php echo e(asset('js/stateEvents.js')); ?>"></script>
	<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>" ></script>
	<script src="<?php echo e(asset('js/app.js')); ?>" ></script>
</body>
</html>