<?php
    
    include_once 'database.php';

    // Calculate elo of each choices after a match
    function compute_elo($winner, $loser) {

        global $new_score_win, $new_score_los;
        
        $dif = abs($winner - $loser);
        $g_var = (40+($dif**1.5)/10)**0.5;
        $h_var = (10/(1+$dif**0.5))*$g_var;
        $l_var=(1/(1+$dif**3))*$g_var;

        if ($winner < $loser) {
            $new_score_win = round($winner + $h_var);
            $new_score_los = round($loser - $h_var);
        } elseif ($winner > $loser) {
            $new_score_win = round($winner + $l_var);
            $new_score_los = round($loser - $l_var);
        } elseif ($dif <= $g_var) {
            $new_score_win = round($winner + $l_var);
            $new_score_los = round($loser);
        }
    }

    function gen_match($conn) {

        global $left_score, $right_score, $left_choice, $right_choice;

        // Get the available choices and their scores from SQL db
        $get_choices = mysqli_query($conn, "SELECT choice FROM items ORDER BY id ASC") or die(mysqli_error());
        $get_scores = mysqli_query($conn, "SELECT score FROM items ORDER BY id ASC") or die(mysqli_error());

        // Fill arrays with choices and scores
        $items = array();
        for($i = 0; $items[$i] = mysqli_fetch_assoc($get_choices); $i++);
        array_pop($items);
        $scores = array();
        for($i = 0; $scores[$i] = mysqli_fetch_assoc($get_scores); $i++);
        array_pop($scores);

        // Choose two random items
        $choices = array_rand($items, 2);

        // Get corresponding choices
        $left_choice = implode($items[$choices[0]]);
        $right_choice = implode($items[$choices[1]]);

        // Get corresponding scores
        $left_score = (int) implode($scores[$choices[0]]);
        $right_score = (int) implode($scores[$choices[1]]);

        echo $left_choice;
        echo $left_choice;
        echo $right_choice;
    }

    gen_match($conn);

    // Behavior when buttons are clicked
    // Left one
    if (isset($_POST['left'])) {
        compute_elo($left_score, $right_score);
        mysqli_query($conn, "UPDATE items SET score = '$new_score_win' WHERE choice = '$left_choice'");
        mysqli_query($conn, "UPDATE items SET score = '$new_score_los' WHERE choice = '$right_choice'");
        header("Location: /index.php");
        exit();
    }

    // Right one 
    if (isset($_POST['right'])) {
        compute_elo($right_score, $left_score);
        mysqli_query($conn, "UPDATE items SET score = '$new_score_los' WHERE choice = '$left_choice'");
        mysqli_query($conn, "UPDATE items SET score = '$new_score_win' WHERE choice = '$right_choice'");
        header("Location: /index.php");
        exit();
    }

?>
