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
                <p>Panel Administratora</p>
            </div>

            <div id="toolbar">
                <ol>
                    <li>
                        <a href="index.php">Kina</a>
                        <ul>
                            <li><a href="kinaPokaz_wszystko.php">Pokaż Kina</a></li>
                            <li><a href="kinaDodaj.php">Dodaj Kino</a></li>
                            <li><a href="seansPokaz_wszystko.php">Pokaż Seans</a></li>
                            <li><a href="seansDodaj.php">Dodaj Seans</a></li>
                            <li><a href="kinaWyszukaj.php">Wyszukaj Kino</a></li>                            
                        </ul>
                    </li>
                    <li>
                        <a href="#">Filmy</a>
                        <ul>
                            <li><a href="filmPokaz_wszystko.php">Pokaż wszystko</a></li>
                            <li><a href="filmDodaj.php">Dodaj Film</a></li>
                            <li><a href="filmWyszukaj.php">Wyszukaj</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Bilety</a>
                        <ul>
                            <li><a href="biletPokaz_wszystko.php">Pokaż wszystko</a></li>
                            <li><a href="biletWyszukaj.php">Wyszukaj</a></li>
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

                echo "<p style='font-size:25px;'>Wybierz Kino:</p>";
                echo "<form action ='#' method='POST'>";
                echo "<select name = 'kinoId'>";

                $sql = "SELECT * FROM Kino";
                $ready = $connettion->query($sql);

                if (!$ready) {
                    die("ERROR");
                }

                foreach ($ready as $value) {
                    echo "<option value = '" . $value['id'] . "'>" . $value['name'] . "</option>";
                }

                echo "</select>";
                echo "<input type ='submit' value ='Pokaż'/>";
                echo "</form><br>";

                if ($_SERVER['REQUEST_METHOD'] === "POST") {
                    if (isset($_POST['kinoId'])) {
                        $kinoId = $_POST['kinoId'];

                        $sql = "SELECT * FROM Seans s LEFT JOIN Kino k ON k.id = s.kino_id 
                                LEFT JOIN Film f ON f.id = s.film_id WHERE s.kino_id = $kinoId";
                        $ready = $connettion->query($sql);

                        if (!$ready) {
                            die("ERROR");
                        }

                        echo "<table>";
                        echo "<tr>";
                        echo "<th>Tytuł</th><th>Opis</th><th>Usuń</th>";
                        echo "</tr>";
                        foreach ($ready as $value) {
							$id = $value['id'];
							
                            echo "<tr>";
                            echo "<td>" . $value['name'] . "</td><td>" . $value['opis'] . "</td><td>";
							$sql = "SELECT * FROM Seans WHERE kino_id=$kinoId AND film_id=$id";
							$ready2 = $connettion->query($sql);
							foreach ($ready2 as $value) {
								$idSeans = $value['id'];
								echo "<a href = 'usun.php?id=$idSeans&table=Seans'>Usuń</a></th>";
								break;
							}
                            echo "</tr>";
                        }
                        echo "</table>";
						echo $idSeans;
                    }
                }
                $connettion->close();
                ?>



            </div>
        </div>    

    </body>

</html>