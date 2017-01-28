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
                            <li><a href="kinaDodaj.php">Dodaj</a></li>
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
               
			   require_once "connect.php";
               
               $connettion = new mysqli($hostname, $user, $password, $database);
               if($connettion->error) {
                   die("Błąd połączenia! ".$connettion->connect_error);
               }                               
               ?>
                <form action="#" method="POST">
                    Wybierz Kino:<br>
                    <select name="kinoId">
                        <?php
                        $sql = "SELECT * FROM Kino";
                        $sql2 = "SELECT * FROM Film";
                        $ready = $connettion->query($sql);
                        $ready2 = $connettion->query($sql2);
                        
                        if (!$ready || !$ready2) {
                            die ("ERROR");
                        }
                        
                        foreach ($ready as $value) {
                            echo "<option value = '" . $value['id'] . "'>" . $value['name'] . "</option>";
                        }
                        
                        echo "</select><br>";
                        echo "Wybierz Film:<br>";
                        echo "<select name = 'filmId'>";
                    
                        foreach ($ready2 as $value) {
                            echo "<option value = '" . $value['id'] . "'>" . $value['name'] . "</option>";
                        }
                        echo "</select><br>";
                        echo "<input type='submit' value='Dodaj'/>";
                        echo "</form>";
                        
                        if ($_SERVER['REQUEST_METHOD'] === "POST") {
                            if (isset($_POST['kinoId']) && $_POST['filmId']) {
                                $kinoId = $_POST['kinoId'];
                                $filmId = $_POST['filmId'];
                                
                                $sql = "INSERT INTO Seans(kino_id, film_id) VALUES ('$kinoId', '$filmId')";
                                $ready = $connettion->query($sql);
                                
                                if (!$ready) {
                                    die("ERROR");
                                } else {
                                    echo "Dodałeś nowy seans do bazy danych.";
                                }
                            }
                        }
                        $connettion->close();
                    ?>
                    
                
            </div>
        </div>    
        
    </body>
    
</html>