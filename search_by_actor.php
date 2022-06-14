<?php
    include_once "init_db.php";
    $req = $conn->prepare("SELECT DISTINCT film.name as name, actor.name as actor_name FROM film
                INNER JOIN film_actor ON film_actor.film_id = film.id
                INNER JOIN actor ON actor.id = film_actor.actor_id
                WHERE actor.name = :selected_actor");
?>

<html>
    <head>
        <title>FILTER RESULTS</title>
    <head>
    <body>
        <h1>
            SEARCH RESULTS:
        </h1>
        <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST')  {
                $selected_actor = $_POST['actor'];
                $req->execute(array(':selected_actor' => $selected_actor));
                $res = $req->fetchAll();

                echo '<p> Found ', count($res), ' films</p>';

                foreach($res as $row) {
                    echo "<div>Title: ", $row["name"], "</div>";
                }
            }
        ?>
    </body>
</html>