<!DOCTYPE html>
<html>
    <head>
        <title>Valuutakalkulaator</title>
    </head>
    <body>
        <form action="index.php" method="POST">
            Algvaluuta summa: <input type="number" name="summa" value="<?php echo (isset($_POST['summa']) ? $_POST['summa'] : "") ?>"><br>
            Suund: <br>
            <input type="radio" name="suund" value="EU" <?php echo(isset($_POST['suund']) && $_POST['suund'] === 'EU' ? "checked" : "" )?>> EUR > USD <br>
            <input type="radio" name="suund" value="UE" <?php echo(isset($_POST['suund']) && $_POST['suund'] === 'UE' ? "checked" : "" )?>> USD > EUR<br>
            <input type="submit" value="Arvuta">
        </form>
    </body>
</html>

<?php
    $teade ="";
    $eurtousd = 1.128255;

    if ($_SERVER['REQUEST_METHOD']=='POST'){
        if (!isset($_POST['summa']) || empty($_POST['summa'])){
            $teade = "Palun sisestage algvaluuta summa <br>";
        } else if (!is_numeric($_POST['summa'])){
            $teade = "Palun sisestage summa täisarvuna<br>";
        }
        if (!isset($_POST['suund']) || (empty($_POST['suund']))){
            $teade = $teade . "Palun sisestage suund";
        }
        if (empty($teade)){
            $summa = htmlspecialchars($_POST['summa']);
            $suund = htmlspecialchars($_POST['suund']);
            if ($suund === 'EU'){
                $vastus = $eurtousd * $summa;
                $teade = $summa . " EUR on " . $vastus . " USD";
            } else if ($suund === 'UE'){
                $vastus = $summa / $eurtousd;
                $teade = $summa . " USD on " . $vastus . " EUR";
            }
        }
    }
    echo $teade;

?>