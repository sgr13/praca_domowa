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
                            <li><a href="filmDodaj.php">Dodaj</a></li>
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
            <div id="contentUsun">
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
                    if (isset($_GET['table']) == TRUE && isset($_GET['id']) == TRUE) {
                        $table = $_GET['table'];
                        $id = $_GET['id'];
                        $sql = "DELETE FROM $table WHERE id = $id";
                        $result = $connettion->query($sql);
                        if ($result == false && $table == 'Kino') {
                            die("Nie mozna usunąć wybranego Kina. Usuń najpierw wszystkie "
                                    . "seanse wyświetlane w tym kinie!");
                        }

                        if ($result == false && $table == 'Film') {
                            die("Nie można usunąć wybranego Filmu. Usuń najpierw wszystkie seanse z danym filmem!");
                        }

                        echo "Udało Ci się usunąć wiersz o id: $id z tabeli: $table<br>";
                        if ($table == 'Kino') {
                            echo "<a href = 'kinaPokaz_wszystko.php'>Powrót do strony głównej</a>";
                        } else if ($table = 'Film') {
                            echo "<a href = 'filmPokaz_wszystko.php'>Powrót do strony głównej</a>";
                        } else if ($table == 'Bilet') {
                            echo "<a href = 'biletPokaz_wszystko.php'>Powrót do strony głównej</a>";
                        }
                    }
                }
                $connettion->close()
                ?>

            </div>
        </div>    

    </body>

</html>