
<!DOCTYPE html>
<html>
	<head>
		<title>results</title>
		<link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="resultsstyle.css">
	</head>
	<body style="background-color: #000;">
		<?php require 'results.php' ?>
		<div class="horizontal_split top">
			<h1><center>R&eacute;sultats</center></h1>
		<div class="horizontal_split midd">
			<?php echo implode($podium[0]), " ", implode($top_scores[0]) ?><br>
			<?php echo implode($podium[1]), " ", implode($top_scores[1]) ?><br>
			<?php echo implode($podium[2]), " ", implode($top_scores[2]) ?><br>
		</div>
		<div class="horizontal_split bottom">
			<button class="btn_add" onclick="window.location.href='nouvel_item.php'">
				<h1><center>Ajouter un item</h1>
			</button>
		</div>
	</body>
</html>