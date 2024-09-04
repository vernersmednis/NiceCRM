<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Companies</title>
</head>
<body>
    <h1>List of Companies</h1>
    <ul>
        @foreach($companies as $company)
            <li>{{ $company->name }}</li>
        @endforeach
    </ul>
</body>
</html>
