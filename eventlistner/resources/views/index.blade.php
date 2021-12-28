<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Index</title>
</head>
<body>
		<form method="POST" action="/subscribe">
			@csrf
			<input type="email" name="email">
			<input type="submit" name="submit">

		</form>

</body>
</html>