<!DOCTYPE html>
<html>

<head>
    <title>User List</title>
</head>

<body>
    <table>
        <thead>
            <th>Name</th>
            <th>E-mail</th>
        </thead>
        <tbody>
            @foreach($bidder as $user)
            <tr>
                <td>{{ $user->bidder_name }}</td>
                <td>{{ $user->bidder_email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>