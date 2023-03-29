<?php
    session_start();
    $result = file_get_contents('http://localhost/git/projetREST/config/service.php',
        true,
        stream_context_create(array('http' => array('method' => 'GET','header' => 'Authorization: Bearer '.$_SESSION['token']))));

    $result = json_decode($result, true);
    $result = $result['data'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Invited</title>
</head>
<body>
    <p> invited </p>

    <?php foreach($result as $t): ?>
    <table>
        <thead>
            <tr>
                <th>auteur</th>
                <th>date</th>
                <th>contenu</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th><?= $t['auteur'] ?></th>
                <th><?= $t['dateP'] ?></th>
                <th><?= $t['contenu'] ?></th>
            </tr>
        </tbody>
    </table>
    <?php endforeach; ?>
</body>
</html>