<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styl.css">
    <title>Komis aut</title>
</head>
<body>
    <header>
        <h1><em><i>KupAuto!</i></em> Internetowy Komis Samochodowy</h1>
    </header>
    <main>
        <section class="m-1">
            <?php
                $conn = new mysqli('localhost','root','','egz_str5');
                
                $sql = "SELECT model, rocznik, przebieg, paliwo, cena, zdjecie FROM samochody WHERE id = 10;";
                $result = $conn -> query($sql);
                $samochody = $result -> fetch_all(1);

                foreach($samochody as $samochod){
                    echo "<img src='pliki/{$samochod["zdjecie"]}' alt='oferta dnia'>";
                    echo "<h4>Oferta dnia: Toyota {$samochod['model']}</h4>";
                    echo "<p>Rocznik: {$samochod['rocznik']}, przebieg: {$samochod['przebieg']}, rodzaj paliwa: {$samochod['paliwo']}</p>";
                    echo "<h4>Cena: {$samochod['cena']}</h4>";
                }
            ?>
        </section>
        <section class="m-2">
            <h2>Oferty Wyroznione</h2>
            <section class="wyr">
            <?php
                $sql = "SELECT nazwa, model, rocznik, cena, zdjecie FROM marki INNER JOIN samochody ON marki.id = samochody.marki_id WHERE wyrozniony = 1 LIMIT 4;";
                $result = $conn -> query($sql);
                $samochody = $result -> fetch_all(1);

                foreach($samochody as $samochod){
                    echo "<div>".
                    "<img src='pliki/{$samochod["zdjecie"]}' alt='{$samochod["model"]}'>".
                    "<h4>{$samochod["nazwa"]} {$samochod["model"]}</h4>".
                    "<p>Rocznik: {$samochod["rocznik"]}</p>".
                    "<h4>Cena: {$samochod["cena"]}</h4>"
                    ."</div>";
                }
            ?>
            </section>
        </section>
        <section class="m-3">
            <h2>Wybierz marke</h2>
            <form action="" method="post">
                <select name="marka" class="lista">
                    <?php
                        $sql = "SELECT nazwa FROM marki;";
                        $result = $conn -> query($sql);
                        $marki = $result -> fetch_all(1);

                        foreach($marki as $marka){
                            echo "<option value='{$marka["nazwa"]}'>{$marka['nazwa']}</option>";
                        }
                    ?>
                </select>
                <button>Wyslij</button>
            </form>
            <section class="wyr">
                <?php
                    $nazwa = $_POST['marka'];
                    $sql = "SELECT nazwa, model, cena, zdjecie FROM samochody INNER JOIN marki ON marki.id = samochody.marki_id WHERE nazwa = '$nazwa';";
                    $result = $conn -> query($sql);
                    $samochody = $result -> fetch_all(1);

                    foreach($samochody as $samochod){
                        echo "<div>".
                        "<img src='pliki/{$samochod["zdjecie"]}' alt='{$samochod["model"]}'>".
                        "<h4>{$samochod["nazwa"]} {$samochod["model"]}</h4>".
                        "<h4>Cena: {$samochod["cena"]}</h4>".
                        "</div>";
                    }
                    $conn -> close();
                ?>
            </section>
        </section>
    </main>
    <footer>
        <p>Stronę wykonał: 000000000</p>
        <p><a href="http://firmy.pl/komis">znajdz nas takze</a></p>
    </footer>
</body>
</html>