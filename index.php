<?php
$xmlFile = "arquivo/preconfig.xml";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $xmlContent = file_get_contents($xmlFile);

    $lines = explode("\n", $xmlContent);
    $updatedLines = [];
    foreach ($lines as $line) {
        if (strpos($line, 'Username="') !== false) {
            $line = preg_replace('/Username="[^"]*"/', 'Username="' . $username . '"', $line);
        }
        if (strpos($line, 'Password="') !== false) {
            $line = preg_replace('/Password="[^"]*"/', 'Password="' . $password . '"', $line);
        }
        $updatedLines[] = $line;
    }

    $updatedXmlContent = implode("\n", $updatedLines);

    $localPath = 'C:\\Backup\\Preconfig02\\'.$username.'.xml';
    if (file_put_contents($localPath, $updatedXmlContent) !== false) {
        echo "Arquivo salvo com sucesso.";
    } else {
        echo "Erro ao salvar o arquivo.";
    }

    header('Content-Disposition: attachment; filename='.$username.'.xml');
    header('Content-Type: application/xml');
    echo $updatedXmlContent;
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <title>Huawei XML editor</title>

</head>
<body class=""> 

<nav class="navbar border-none border-4 rounded align-self-center" id="nav-bar">
        <div class="">
            <a class="navbar-brand float-left" href="#">
                <img src="img/Huawei.svg" alt="huawei" width="150" height="90" class="">
            </a>
        </div>
    </nav>


    <div class="container w-50 h-50 vh-100 d-flex justify-content-center align-items-center">
       
    <form method="post">
        
            <div class="input-group grid gap-0 column-gap-5" id="div-form">
                <div class="form-floating mt-5">
                    <!-- <span class="col-md-5 input-group-text fw-bold fst-italic opacity-50" id="inputGroup-sizing-sm">User</span> -->
                    <input type="text" class="form-control container bg-dark-subtle shadow opacity-100" name="username" id="username" placeholder="" required>
                    <label for="floatingInput" id="label-user">Username</label>
                </div>

                <div class="form-floating mt-5">
                    <!-- <span class="col-md-5 input-group-text fw-bold fst-italic opacity-50" id="inputGroup-sizing-sm">Pass</span> -->
                    <input type="password" class="form-control bg-dark-subtle shadow opacity-100" name="password" id="password" placeholder="" required>
                    <label for="floatingInput" id="label-pass">Password</label>
                </div>

            </div>

            <div class="d-flex justify-content-center" id="save-button">
                <input type="submit" class="btn btn-primary fw-semibold shadow w-25" value="Salvar">
            </div>
        </form>
    </div>

</body>
</html>
