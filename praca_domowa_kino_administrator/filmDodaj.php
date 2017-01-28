<!DOCTYPE HTML>

<html lang="pl">

    <head>
        <meta charset="utf-8"/>
        <title>Praca Domowa</title>
        <link rel="stylesheet" href="style.css" type="text/css"/> 
    </head>

    <body>
        <div id="container">
            <li><a href="kinaPokaz_wszystko.php">Pokaż Kina</a></li>
            <li><a href="kinaDodaj.php">Dodaj Kino</a></li>
            <li><a href="seansPokaz_wszystko.php">Pokaż Seans</a></li>
            <li><a href="seansDodaj.php">Dodaj Seans</a></li>
            <li><a href="kinaWyszukaj.php">Wyszukaj Kino</a></li>
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
            <div id="contentDodaj">
                <?php
                
				require_once(connect.php);

                $connettion = new mysqli($hostname, $user, $password, $database);
                if ($connettion->error) {
                    die("Błąd połączenia! " . $connettion->connect_error);
                }

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    echo "działa<br>";
                    if (isset($_POST['name']) && isset($_POST['opis']) && isset($_POST['rating'])) {
                        $name = $_POST['name'];
                        $opis = $_POST['opis'];
                        $rating = $_POST['rating'];
                        $sql = "INSERT INTO Film (name, opis, ocena) VALUES ('$name', '$opis', '$rating')";
                        $result = $connettion->query($sql);
                        if ($result === TRUE) {
                            echo "Dodałeś Film pod tytułem: <span id=kino> $name</span> i opisie: <span id=kino>"
                            . "$opis</span> oceniony na: <span id='kino'>$rating</span><br><br>";
                        } else {
                            echo "nie udało się dodać kina do bazy danych!<br>";
                        }
                    }
                }
                $connettion->close();
                ?>
                <form action="#" method="POST">
                    Podaj  nazwę filmu:<br>
                    <input type="text" name="name" /><br>
                    Podaj opis filmu:<br>
                    <input type="text" name="opis"/><br>
                    Podaj ocenę filmu<br>
                    <input type="number" name="rating" min="1" max="10" maxlength="2"/>
                    <input type="submit" value="Wyślij"/>
                </form>
            </div>
        </div>    

    </body>

</html>