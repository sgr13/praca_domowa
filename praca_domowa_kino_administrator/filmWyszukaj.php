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
            <div id="contentWyszukaj">
                <?php
                
				require_once "connect.php";

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
                        <option value="opis">opis</option>
                        <option value="ocena">ocena</option>

                    </select>
                    <input type="submit" value="szukaj"/>
                </form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['text']) && isset($_POST['type'])) {
        $text = $_POST['text'];
        $type = $_POST['type'];
        $sql = "SELECT * FROM Film WHERE $type LIKE '%$text%'";
        $result = $connettion->query($sql);
        $table = 'Film';

        echo "<br><table id='tab'>";
        echo "<tr>";
        echo "<th>Id</th><th>Tytuł</th><th>Opis</th><th>Ocena</th><th>Usuń</th>";
        echo "</tr>";
        foreach ($result as $value) {
            $id = $value['id'];
            echo "<tr>" . "<td>" . $value['id'] . "</td><td>" . $value['name'] . "</td><td>" . $value['opis'] . 
            "</td><td>" . $value['ocena'] . "</td><td><a href='usun.php?table=$table&id=$id'>usuń</a></td></tr>";
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