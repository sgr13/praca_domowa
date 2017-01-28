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
                $sql = "SELECT * FROM Film";
                $result = $connettion->query($sql);
                $table = 'Film';

                echo "<table>";
                echo "<tr>";
                echo "<th>Id</th><th>Tytuł</th>";
                echo "</tr>";
                foreach ($result as $value) {
                    $id = $value['id'];
                    echo "<tr>" . "<td>" . $value['id'] . "</td><td><a href='movieDetails.php?id=$id'>" .
                    $value['name'] . "</a></td>";
                }
                echo "</table>";
                $connettion->close();
                ?>



            </div>
        </div>    

    </body>

</html>