<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztrált Autók</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <main class="container">
        <h1>Regisztrált Autók</h1>
        <button class="btn btn-success"><a href="regisztracio.php" style="text-decoration:none; color:white;">Új autó felvétele</a></button>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Rendszám</th>
                    <th>Márka</th>
                    <th>Modell</th>
                    <th>Gyártás Éve</th>
                    <th>Üzemanyag Típusa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $autok = [];
                    if (($handle = fopen("autok.csv", "r")) !== false) {
                        while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                            $autok[] = $data;
                        }
                        fclose($handle);
                    }
                    foreach ($autok as $auto) {
                        echo "<tr>";
                        foreach ($auto as $value) {
                            echo "<td>$value</td>";
                        }
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>