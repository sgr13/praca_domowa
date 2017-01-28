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
                <p>Polskia sieć kin</p>
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
               if($connettion->error) {
                   die("Błąd połączenia! ".$connettion->connect_error);
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
                
                if($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if(isset($_POST['text']) && isset($_POST['type'])) {
                        $text = $_POST['text'];
                        $type = $_POST['type'];
                        echo "Podałeś $text z kolumny: $type<br>";
                        $sql = "SELECT * FROM Film WHERE $type LIKE '%$text%'";
                        $result = $connettion->query($sql);
                        $table = 'Film';
                        
                echo "<table id='tab'>";
                echo "<tr>";
                echo "<th>Id</th><th>Tytuł</th>";
                echo "</tr>";
                foreach ($result as $value) {
                    $id = $value['id'];
                    echo "<tr>" . "<td>" . $value['id'] . "</td><td><a href='movieDetails.php?id=$id'>"
                            . $value['name'] . "</a></td>";
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