<?php
    include_once "init_db.php";
    $req = $conn->prepare("SELECT name FROM film
                WHERE date >= :from AND date <= :to");
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
                $from = $_POST["from"];
                $to = $_POST["to"];
                $req->execute(array(':from' => $from, ':to' => $to));
                $res = $req->fetchAll();

                echo '<p> Found ', count($res), ' films</p>';

                foreach($res as $row) {
                    echo "<div>Title: ", $row["name"], "</div>";
                }
            }
        ?>
    </body>
</html>