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
                <p>Polaska sieć kin</p>
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
            <div id="contentWyszukaj">
                <?php
                $hostname = 'localhost';
                $user = 'root';
                $password = 'coderslab';
                $database = 'cinemas_db';

                $connettion = new mysqli($hostname, $user, $password, $database);
                if ($connettion->error) {
                    die("Błąd połączenia! " . $connettion->connect_error);
                }
                ?>

                <form action="#" method="POST">
                    <p>Podaj szukaną frazę:</p>
                    <input type="text" name="text"/>
                    <select name="type">
                        <option value="id">id</option>
                        <option value="name">nazwa</option>
                        <option value="adress">adres</option>

                    </select>
                    <input type="submit" value="szukaj"/>
                </form>
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (isset($_POST['text']) && isset($_POST['type'])) {
                        $text = $_POST['text'];
                        $type = $_POST['type'];
                        $sql = "SELECT * FROM Kino WHERE $type LIKE '%$text%'";
                        $result = $connettion->query($sql);
                        $table = 'Kino';

                        echo "<table id='tab'>";
                        echo "<tr>";
                        echo "<th>Id</th><th>Nazwa</th><th>Adres</th><th>Repertuar</th>";
                        echo "</tr>";
                        foreach ($result as $value) {
                            $id = $value['id'];
                            echo "<tr>" . "<td>" . $value['id'] . "</td><td>" . $value['name'] . "</td><td>" . $value
                            ['adress'] . "</td><td><a href='repertuar.php?table=$table&id=$id'>Pokaż</a></td></tr>";
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