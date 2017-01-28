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
                <p>Polska sieć Kin</p>
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
                $hostname = 'localhost';
                $user = 'root';
                $password = 'coderslab';
                $database = 'cinemas_db';

                $connettion = new mysqli($hostname, $user, $password, $database);
                if ($connettion->error) {
                    die("Błąd połączenia! " . $connettion->connect_error);
                }

                if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                    if (isset($_GET['id']) == true) {
                        $id = $_GET['id'];

                        $sql = "SELECT * FROM Film f LEFT JOIN Seans s ON f.id=s.film_id "
                                . "LEFT JOIN Kino k ON k.id=s.kino_id WHERE s.film_id=$id";

                        $sql2 = "SELECT * FROM Film WHERE id=$id";

                        $ready = $connettion->query($sql);
                        $ready2 = $connettion->query($sql2);

                        if (!$ready || !$ready2) {
                            die("ERROR" . $connettion->connect_error);
                        }
                        foreach ($ready2 as $value) {
                            echo "<span style = 'font-size: 25px;'>Tytuł wybranego filmu: </span><br>";
                            echo "<span style = 'font-size:30px; color: darkgreen;'>" . $value['name'] . "</span><br><br>";
                            echo "<span style = 'font-size: 25px;'>Opis wybranego filmu: </span><br>";
                            echo "<span style = 'font-size:30px; color: darkgreen;'>" . $value['opis'] . "</span><br><br>";
                            echo "<span style = 'font-size: 25px;'>Średnia ocena filmu: </span><br>";
                            echo "<span style = 'font-size:30px; color: darkgreen;'>" . $value['ocena'] . "</span><br><br>";
                        }

                        echo "<span style='font-size:20px;'>Lista kin aktualnie wyświetlającyh wybrany film"
                        . ":</span> <br>";
                        echo "<table >";
                        echo "<tr>";
                        echo "<th >Nazwa</th><th>Adres</th><th>Rezerwacja</th>";
                        echo "</tr>";
                        foreach ($ready as $value) {
                            echo "<tr>";
                            $movieId = $value['film_id'];
                            $cinemaId = $value['kino_id'];
                            echo "<td>" . $value['name'] . "</td><td> " . $value['adress'] . "</td><td> "
                            . "<a href='kup.php?movieId=$movieId&cinemaId=$cinemaId'>Kup bilet</a></td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    }
                }
                $connettion->close();
                ?>

            </div>
        </div>    

    </body>

</html>