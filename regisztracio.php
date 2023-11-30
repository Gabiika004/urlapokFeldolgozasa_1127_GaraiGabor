<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autó Regisztráció</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <main class="container">
        <?php 
        if (isset($_POST["submit"])) {
            $errors = [];
            $rendszam = validateInput($_POST["rendszam"]);
            $marka = validateInput($_POST["marka"]);
            $modell = validateInput($_POST["modell"]);
            $ev = validateInput($_POST["ev"]);
            $uzemanyag = validateInput($_POST["uzemanyag"]);

            if (!$rendszam || !$marka || !$modell || !$ev || !$uzemanyag) {
                $errors[] = "Minden adatot meg kell adni!";
            }

            if (!is_numeric($ev) || $ev <= 0) {
                $errors[] = "Érvénytelen gyártási év!";
            }

            $uzemanyag_lista = ["benzin", "gazolaj", "elektromos", "hibrid"];
            if (!in_array($uzemanyag, $uzemanyag_lista)) {
                $errors[] = "Érvénytelen üzemanyag típus!";
            }

            if (empty($errors)) {
                $autok[] = [$rendszam, $marka, $modell, $ev, $uzemanyag];

                $file = fopen("autok.csv", "a");
                fputcsv($file, [$rendszam, $marka, $modell, $ev, $uzemanyag]);
                fclose($file);

                echo "<h1 class='text-success'>Sikeres regisztráció</h1>";
            } else {
                foreach ($errors as $error) {
                    echo "<p class='text-danger'>$error</p>";
                }
            }
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="mb-3">
                <label for="rendszam" class="form-label">Rendszám</label>
                <input type="text" name="rendszam" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="marka" class="form-label">Márka</label>
                <input type="text" name="marka" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="modell" class="form-label">Modell</label>
                <input type="text" name="modell" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="ev" class="form-label">Gyártás Éve</label>
                <input type="number" name="ev" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="uzemanyag" class="form-label">Üzemanyag Típusa</label>
                <select name="uzemanyag" class="form-select" required>
                    <option value="benzin">Benzin</option>
                    <option value="gazolaj">Gázolaj</option>
                    <option value="elektromos">Elektromos</option>
                    <option value="hibrid">Hibrid</option>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-outline-success">Regisztráció</button>
            <button class="btn btn-success"><a href="index.php" style="text-decoration:none; color:white;">Regisztrált autók</a></button>
        </form>
    </main>
</body>
</html>

<?php
function validateInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>