
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to The Application</title>

<style>
    body {
        /* font-family: Arial, sans-serif; */
        background-color: #dfd8d8;
        /* color: #333; */}

    table{
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        text-align: center;
        border-radius: 5px;}

    a.btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #5d96d4;
        color: #fff;
        text-decoration: none;  
        border-radius: 5px;
        font-size: 1.5em;
        margin-top: 20px;}
</style>

</head>
<body>
    <table cellspacing="0" cellpadding="0" border="0" width="100%">
        <tr>
            <td>
                <!--content email  -->
                <h1>Welcome to The Application {{$name}}</h1>
                <p>Thank you for signing up!</p>
                <a href="http://aplikasi1.test/activate/{{$code}}" class="btn">Click Here</a>
            </td>
        </tr>
    </table>
</body>
</html>