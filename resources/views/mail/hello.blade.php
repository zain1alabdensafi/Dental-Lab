<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        .main-header {
            background-color: #3498db; 
            color: #fff;
            height: 80px;
            padding-top: 30px;
            text-align: center;
        }
        .main-content {
            background-color: #ecf0f1; 
            color: #2c3e50; 
            padding: 20px;
            line-height: 1.6em;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="main-header">
            <h1>Welcome to Dental LAB Application</h1>
        </header>
        <div class="main-content">
            <h2>Hello {{$user->first_name}},</h2>
            <p>We're glad to see you here! Enjoy exploring Our Application.</p>
        </div>
    </div>
</body>
</html>
