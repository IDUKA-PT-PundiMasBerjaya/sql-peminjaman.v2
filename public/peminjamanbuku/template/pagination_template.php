<?php 
    if ($totalPage > 1) {
        echo "<div>";
        for ($i = 1; $i <= $totalPage; $i++) {
            if ($i == $page) {
                echo "<b>$i</b> ";
            } else {
                echo "<a href='?page=$i&perPage=$perPage'>  $i</a>";
            }
        }
        echo "</div>";
    }
?>