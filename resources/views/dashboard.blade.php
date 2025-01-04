<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>
    <h1>Dashboard: Employee Requests</h1>

    @if (session('message'))
        <div style="color: green;">{{ session('message') }}</div>
    @endif

    @if (session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requests as $request)
                <tr>
                    <td>{{ $request->name }}</td>
                    <td>{{ $request->email }}</td>
                    <td>
                        <!-- قبول الطلب -->
                        <a href="{{ route('acceptRequest', $request->id) }}" style="color: green;">Accept</a> |
                        <!-- رفض الطلب -->
                        <a href="{{ route('rejectRequest', $request->id) }}" style="color: red;">Reject</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
