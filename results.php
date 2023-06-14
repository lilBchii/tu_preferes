<?php

	include_once 'database.php';

    // Get the available choices and their scores from SQL db
    $get_choices = mysqli_query($conn, "SELECT choice FROM items ORDER BY score DESC") or die(mysqli_error());
    $get_scores = mysqli_query($conn, "SELECT score FROM items ORDER BY score DESC") or die(mysqli_error());

    // Fill arrays with choices and scores
    $items = array();
    for($i = 0; $items[$i] = mysqli_fetch_assoc($get_choices); $i++);
    array_pop($items);
    $scores = array();
    for($i = 0; $scores[$i] = mysqli_fetch_assoc($get_scores); $i++);
    array_pop($scores);

    $podium = [$items[0], $items[1], $items[2]];
    $top_scores = [$scores[0], $scores[1], $scores[2]]

?>