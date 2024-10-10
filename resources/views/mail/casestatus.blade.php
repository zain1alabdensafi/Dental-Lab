<!DOCTYPE html>
<html>
<head>
    <title >Case Details</title>
    <style >
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .container {
            width: 80%;
            margin: auto;
            background-color: #fff;
            padding: 30px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            border-radius: 15px;
        }
        h2 {
            color: chocolate; /* A lovely shade of purple */
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
        p {
            color: chocolate; /* A darker shade of purple */
        }
     
        /* Add some styles for the table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: green;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Case Details:</h2>

        

        <!-- Add the table here -->
        <table>
            <tr>
                <th>Case id</th>
                <th>Patient Name</th>
                <th>Status</th>
            </tr>
            <tr>
                <td><p style="color: black">{{$case->id }}</p></td>
                <td><p style="color: black">{{ $case->patient_name }}</p></td>
                <td><p style="color: green;">The case status is Done. You can pick it up from the lab at any time.</p></td>
            </tr>
        </table>

        <div>
            <h3>We're glad you're using our app!</h3>
        </div>
    </div>
</body>
</html>
