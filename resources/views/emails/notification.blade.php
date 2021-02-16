<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Company registration</title>
</head>
<body>
<p>
    Dear {{ $data['name'] }}
</p>
<p>
    {{ $data['base_currency'] }} is less than {{ $data['price'] }} to {{ $data['user_currency'] }},
</p>

<p>
    Kind regards,
</p>

<p>
    Currency updates
</p>


</body>
</html>
