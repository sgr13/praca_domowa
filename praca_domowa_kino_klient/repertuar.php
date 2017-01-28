<!DOCTYPE HTML>

<html lang="pl">

    <head>
        <meta charset="utf-8"/>
        <title>Praca Domowa</title>
        <link rel="stylesheet" href="style.css" type="text/css"/> 
    </head>

    <body>
        <div id="container">

            <div id="head">
                <p>Polska sieć kin</p>
            </div>

            <div id="toolbar">
                <ol>
                    <li>
                        <a href="index.php">Kina</a>
                        <ul>
                            <li><a href="kinaPokaz_wszystko.php">Pokaż wszystko</a></li>
                            <li><a href="kinaWyszukaj.php">Wyszukaj</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Filmy</a>
                        <ul>
                            <li><a href="filmPokaz_wszystko.php">Pokaż wszystko</a></li>
                            <li><a href="filmWyszukaj.php">Wyszukaj</a></li>
                        </ul>
                    </li>
                </ol>
            </div>
            <div id="content">
                <?php
                
				require_once "connect.php";

                $connettion = new mysqli($hostname, $user, $password, $database);
                if ($connettion->error) {
                    die("Błąd połączenia! " . $connettion->connect_error);
                }

                if ($_SERVER['REQUEST_METHOD'] === "GET") {
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                    }
                }

                $sql = "SELECT * FROM Kino k LEFT JOIN Seans s ON k.id=s.kino_id "
                        . "LEFT JOIN Film f ON f.id = s.film_id  WHERE s.kino_id=$id";
                $result = $connettion->query($sql);

                if (!$result) {
                    die("ERROR");
                }

                echo "<p style ='text-align: center; font-size: 25px;'>Aktualne senase filmowe:</p>";
                echo "<table>";
                echo "<tr>";
                echo "<th>Tytuł</th><th>Opis</th><th>Kup Bilet</th>";
                echo"</tr>";

                foreach ($result as $value) {
                    $movieId = $value['film_id'];
                    $cinemaId = $value['kino_id'];
                    echo "<tr>";
                    echo "<td>" . $value['name'] . "</td><td>" . $value['opis'] . "</td>" .
                    "<td><a href='kup.php?movieId=$movieId&cinemaId=$cinemaId'>Kup</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
                $connettion->close();
                ?>



            </div>
        </div>    

    </body>

</html>