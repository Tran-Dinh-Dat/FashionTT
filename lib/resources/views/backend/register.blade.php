<!DOCTYPE html>
<html lang="en" >

<head>
	<meta charset="UTF-8">
	<title>Login & Sign Up</title>
	<link href="{{asset('lib/public/css/login.css')}}" rel="stylesheet" id="bootstrap-css">
	

</head>
<body>
	<div class="wrapper fadeInDown">
		<div id="formContent">
			<!-- Tabs Titles -->
			<h2 class="inactive underlineHover"><a href="{{route('login')}}" title="">Sign In</a> </h2>
			<h2 class="active">Sign Up </h2>
			<!-- Login Form -->
			@include('errors.error')
			<form action="{{route('registered')}}" method="POST" >
				@csrf
				<input type="text" id="login" class="fadeIn second" name="username" placeholder="Username" value="{{old('username')}}">
				<input type="text"  class="fadeIn third" name="email" placeholder="Email" value="{{old('email')}}">	
				<input type="password" id="password" class="fadeIn third" name="password" placeholder="Password" value="{{old('password')}}">
				<input type="submit" class="fadeIn fourth" value="Register"><br>

			</form>


		</div>

	</div>
</body>
<script type="text/javascript" src="{{asset('lib/public/js/bootstrap-3.1.1.min.js')}}"></script>
<script type="text/javascript">
	setTimeout(function() {
	$('#status').slideUp('slow');
}, 3000);
</script>
</html>
