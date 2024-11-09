<?php
if (isset($_POST['exampleCheckbox'])) {
    // Checkbox is aangevinkt
    $waarde = $_POST['exampleCheckbox']; // De waarde is 'ja' zoals gespecificeerd in het formulier
    echo "De checkbox is aangevinkt en de waarde is: " . htmlspecialchars($waarde);
} else {
    // Checkbox is niet aangevinkt
    echo "De checkbox is niet aangevinkt.";
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="">
        <input type="checkbox" name="exampleCheckbox" value="ja"> Klik hier
        <input type="submit" value="Verstuur">
    </form>
</body>
</html>