<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form method="get" action='/jogodobicho/proxy/route_requests.php'>
    <input type="text" name="url" hidden value="<?= urlencode(string: basename(path: __FILE__))?>" >
    <button type="submit">Enviar</button>
</form>
    
</body>
</html>