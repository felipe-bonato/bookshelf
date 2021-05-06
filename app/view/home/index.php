<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bookshelf!</title>
</head>
<body>
	<h1>Hello from inside home's view, <?php htmlspecialchars($name); ?>!</h1>
	<h2>Programming Languages:</h2>
	<ul>
		<?php foreach($languages as $lang): ?>
			<li><?php echo htmlspecialchars($lang); ?></li>
		<?php endforeach; ?>
	</ul>
</body>
</html>