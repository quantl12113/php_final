<!DOCTYPE html>
<html>
<head>
	<title>Activation Email - Foody.com</title>
</head>
<body>
	<p>
		Chào mừng {{ $user->name }} đã đăng ký thành viên tại Foody.com. Bạn hãy click vào đường link sau đây để hoàn tất việc đăng ký và đăng nhập.
		</br>
		<a href="{{ $user->activation_link }}">{{ $user->activation_link }}</a>
	</p>
</body>
</html>