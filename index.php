
<!DOCTYPE html>
<html>
    <head>
        <title>Tu préfères ?</title>
        <!-- <link rel="icon" type="image/x-icon" href="https://img.freepik.com/vecteurs-libre/illustration-icone-vecteur-dessin-anime-mignon-poulpe-colere-concept-icone-nature-animale-isole-vecteur-premium-style-dessin-anime-plat_138676-3635.jpg">-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="homestyle.css">
    </head>
    <body>

        <?php require 'get_items.php';?>

        <div class="horizontal_split top">
            <h1><center>Tu pr&eacute;f&egrave;res </h1>
        </div>
        <div class="horizontal_split midd">
            <form method="post" action="get_items.php">
                <input name="info_left" type="hidden" value="<?php echo $left_id ?>">
                <input name="info_right" type="hidden" value="<?php echo $right_id ?>">
                <input name="info_left_score" type="hidden" value="<?php echo $left_score ?>">
                <input name="info_right_score" type="hidden" value="<?php echo $right_score ?>">
                <div  class="vertical_split left">
                    <input name="left" class="button1" type="submit" value="<?php echo $left_choice ?>">
                </div>
                <div class="btn vertical_split right">
                    <input name="right" class="button2" type="submit"  value="<?php echo $right_choice ?>">
                </div>
            </form>
        <div class="horizontal_split bottom">
            <button class="button3" onclick="window.location.href='résultats.php'">
                <h1><center>R&eacute;sultats </h1>
            </button>
        </div>
    </body>
</html>
