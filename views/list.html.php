<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8"/>
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Αρχεία στο Dropbox του χρήστη</h1>
    <ul>
        <?php foreach ($array as $value): ?>
            <li><?=$value;?></li>
        <?php  endforeach; ?>
    </ul>
</body>
</html>