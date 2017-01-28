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
                echo "<p style = 'font-size:30px; text-align: center;'>Kup Bilet</p>";
                if ($connettion->error) {
                    die("Błąd połączenia! " . $connettion->connect_error);
                }

                if ($_SERVER['REQUEST_METHOD'] === "POST") {
                    if (isset($_POST['price']) && isset($_POST['paymentForm']) && isset($_POST['quantity'])) {
                        echo "<p style = ' text-align: center; font-size: 30px; color: darkgreen;'> "
                        . "Operacja zakończona sukcesem. Miłego Seansu<br>";
                        $price = $_POST['price'];
                        $paymentForm = $_POST['paymentForm'];
                        $quantity = $_POST['quantity'];
                        $date = date("Y-m-d");


                        $sql = "INSERT INTO Platnosc(typ, data) VALUES ('$paymentForm', '$date')";
                        $ready = $connettion->query($sql);
                        if (!$ready) {
                            die("ERROR1");
                        }
                        $id = $connettion->insert_id;
                        $sql = "INSERT INTO Bilet (ilosc, cena, id_platnosc) Values ('$quantity', '$price', '$id')";
                        $ready = $connettion->query($sql);
                        if (!$ready) {
                            die("ERROR2");
                        }
                    }
                } else {


                    if ($_SERVER['REQUEST_METHOD'] === "GET") {
                        if (isset($_GET['movieId']) && isset($_GET['cinemaId'])) {
                            $movieId = $_GET['movieId'];
                            $cinemaId = $_GET['cinemaId'];


                            $sql = "SELECT * FROM Film WHERE id=$movieId";
                            $ready = $connettion->query($sql);
                            if (!$ready) {
                                die("ERROR" . $connettion->connect_error);
                            }
                            ?>
                            <p style="font-size: 30px;">Zakup biletów:</p>
                            <form action="#" method="POST">
                                Ilość: <br>
                                <input type="number" size="1" min="1" name="quantity"/><br><br>
                                Cena:<br>
                                <select name="price">
                                    <option value ="15.99">15.99zł</option>
                                    <option value ="20.99">20.99zł</option>
                                    <option value ="25.99">25.99zł</option>
                                    <option value ="29.99">29.99zł</option>
                                </select><br><br>
                                Sposób płatności:<br>
                                <select name="paymentForm">
                                    <option value="karta">Karta</option>
                                    <option value="gotowka">Gotówka</option>
                                    <option value="przelew">Przelew</option>
                                </select>
                                <br><br><input type="submit" value="Kup"/>
                            </form>

                            <?php
                        }
                    }
                }
                $connettion->close();
                ?>
            </div>
        </div>    

    </body>

</html>