<?php
    
    include_once 'database.php';

    // Calculate elo of each choices after a choice
    function compute_elo($winner, $loser) {
        
        $dif = abs($winner - $loser);
        $g_var = (40+($dif**1.5)/10)**(1/1.3);
        $h_var = (10/(1+$dif**0.5))*$g_var;
        $l_var=(1/(1+$dif**1.5))*$g_var;

        if ($winner < $loser) {
            $new_score_win = round($winner + $h_var);
            $new_score_los = round($loser - $h_var);
        } elseif ($winner >= $loser) {
            $new_score_win = round($winner + $l_var);
            $new_score_los = round($loser - $l_var);
        }

        return [$new_score_win, $new_score_los];
    }

    // Get the items from SQL db
    $list_items = mysqli_query($conn, "SELECT * FROM items ORDER BY id ASC");
    
    // Fetch array
    while($row = mysqli_fetch_array($list_items)){
        $tab_list_items[] = $row;
    }

    // Choose two random ids
    $chosen = array_rand($tab_list_items, 2);

    var_dump($chosen);

    // Get ids
    $left_id = $tab_list_items[$chosen[0]]['id'];
    $right_id = $tab_list_items[$chosen[1]]['id'];

    // Get scores
    $left_score = $tab_list_items[$chosen[0]]['score'];
    $right_score = $tab_list_items[$chosen[1]]['score'];

    // Get Strings
    $left_choice = $tab_list_items[$chosen[0]]['choice'];
    $right_choice = $tab_list_items[$chosen[1]]['choice'];

    // Behavior when buttons are clicked
    // Left one
    if (isset($_POST['left'])) {

        $left_id = $_POST['info_left'];
        $right_id = $_POST['info_right'];
        $left_score = $_POST['info_left_score'];
        $right_score = $_POST['info_right_score'];

        $scores = compute_elo($left_score, $right_score);
        $winner_score = $scores[0];
        $loser_score = $scores[1];

        mysqli_query($conn, "UPDATE items SET score = '$winner_score' WHERE id = '$left_id'");
        mysqli_query($conn, "UPDATE items SET score = '$loser_score' WHERE id = '$right_id'");
        header("Location: /index.php");
        exit();
    }

    // Right one 
    if (isset($_POST['right'])) {

        $left_id = $_POST['info_left'];
        $right_id = $_POST['info_right'];
        $left_score = $_POST['info_left_score'];
        $right_score = $_POST['info_right_score'];

        $scores = compute_elo($right_score, $left_score);
        $winner_score = $scores[0];
        $loser_score = $scores[1];

        mysqli_query($conn, "UPDATE items SET score = '$winner_score' WHERE id = '$right_id'");
        mysqli_query($conn, "UPDATE items SET score = '$loser_score' WHERE id = '$left_id'");
        header("Location: /index.php");
        exit();
    }

?>
