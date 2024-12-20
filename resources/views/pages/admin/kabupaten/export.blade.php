<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Kabupaten</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th style="border: 3px; background-color:gray; font-weight:bolder; text-align:center;">id</th>
                <th style="border: 3px; background-color:gray; font-weight:bolder; text-align:center;">type</th>
                <th style="border: 3px; background-color:gray; font-weight:bolder; text-align:center;">name</th>
                <th style="border: 3px; background-color:gray; font-weight:bolder; text-align:center;">code</th>
                <th style="border: 3px; background-color:gray; font-weight:bolder; text-align:center;">provinsi_id</th>
                <th style="border: 3px; background-color:gray; font-weight:bolder; text-align:center;">provinsi</th>
                <th style="border: 3px; background-color:gray; font-weight:bolder; text-align:center;">full_code</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->type }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->code }}</td>
                    <td>{{ $item->provinsi_id }}</td>
                    <td>{{ $item->provinsi->name ?? '' }}</td>
                    <td>{{ $item->provinsi->code ?? '' }}{{ $item->code }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
