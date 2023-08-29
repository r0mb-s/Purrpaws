<?php

$servername = "localhost";
$username = "root";
$password = "cita2004";
$dbname = "purrpaws";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$sql = "SELECT prenume, nume FROM users WHERE id=?";

$stmt = $conn->prepare($sql);
$stmt->execute([$_POST['id']]);
$ok = $stmt->fetch();

$sql = "SELECT id_produs, cantitate FROM comenzi WHERE id_client=?";

$stmt = $conn->prepare($sql);
$stmt->execute([$_POST['id']]);
$ok2 = $stmt->fetchAll();

$table = "<table style=\"display:inline-block; text-align: center;border: 1px solid black;\"><tr><th >Id</th><th>Nume</th><th>Pret</th><th>Cantitate</th><th>Pret total</th></tr>";

foreach($ok2 as $idk){
    $sql = "SELECT nume, pret FROM produse WHERE id=?";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$idk[0]]);
    $ok3 = $stmt->fetchAll();

    $table .= "<tr>";
    $table .= "<td>" . $idk[0] . "</td>" . "<td>" . $ok3[0][0] . "</td>" . "<td>" . $ok3[0][1] . "</td>" . "<td>" . $idk[1] . "</td>" . "<td>" . ($ok3[0][1] * $idk[1]) . "</td></tr>";
}

$table .= "</table>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" href="../CSS/shop-style.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <title>Shop</title>
</head>
<body>
    <a href="../index.html"><img src="../Images/home-icon.png" width="3%" height="3%"></a>
    <div id="mesaj-bun-venit">
        <p>Bine ai venit, <?php echo $ok[0] . " " . $ok[1] ?> !</p>
    </div>
    <div id="meniu">
        <button id="but1">Pune o comanda</button>
        <button id="but2">Vezi istoric comenzi</button>
    </div>
    <div id="comanda">
        <form id="target">
            <table>
                <tr>
                    <td colspan="2" style="padding: 5%;">Plasare comanda</td>
                </tr>
                <tr>
                    <td><label for="produse">Produs:</label></td>
                    <td>
                        <select id="produse" name="produse">
                            <option value="1">Mancare uscata</option>
                            <option value="2">Dulciuri</option>
                            <option value="3">Mancare umeda cu bulion</option>
                            <option value="4">Mancare umeda jeleu natural</option>
                            <option value="5">Conserva peste</option>
                            <option value="6">Conserva amestec</option>
                        </select> 
                    </td>
                </tr>
                <tr>
                    <td><label for="cant">Cantitate</label></td>
                    <td><input id="cant" type="text" name="cant" required value="1"></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 5%;"><input id="submit" type="submit" value="Cumpara"></td>
                </tr>
            </table>
        </form>
    </div>
    <div id="istoric">
        <?php echo $table; ?>
    </div>
    <script>
        $(document).ready(function(){
            $("#but1").on("click", function(){
                $('#istoric').hide();
                $("#comanda").show();
            });
            $('#target').submit(function(){
                event.preventDefault();
                $.post("comanda.php", { id_client : <?php echo $_POST['id'] ?>, id_produs : $("#produse").val(), cantitate : $("#cant").val() })
                alert("Succes");
                location.reload();
            });
            $("#but2").on("click", function(){
                $("#comanda").hide();
                $('#istoric').show();
            });
        });
    </script>
</body>
</html>
