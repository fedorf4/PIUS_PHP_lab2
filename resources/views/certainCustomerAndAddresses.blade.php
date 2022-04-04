<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab2 task2</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <h1>Customer</h1>
    <div>
        <table>
            <tr><th>id</th><th>Name</th><th>Surname</th><th>Is blocked</th><th>Phone</th><th>Email</th><th>Registration date</th></tr>          
                <tr>
                <td>{{$customer->id}}</td>
                <td>{{$customer->name}}</td>
                <td>{{$customer->surname}}</td>
                <td>{{$customer->is_blocked}}</td>
                <td>{{$customer->phone}}</td>
                <td>{{$customer->email}}</td>
                <td>{{$customer->created_at}}</td>
                </tr>
        </table>     
    </div>
    <div>
        @if (count($customer->addresses) === 0)
        <div style="font-style:italic;">
            This customer has no addresses!
        </div>
        @else
        <h2> Addresses </h2>
        <table>
            <tr><th>id</th><th>Name by customer</th><th>City</th><th>Street/District</th><th>House number</th><th>Floor</th><th>Flat number</th><th>Intercome code</th><th>Customer id</th><th>Added at</th></tr>          
            @foreach ($customer->addresses as $address)
                <tr>
                <td>{{$address->id}}</td>
                <td>{{$address->name_from_customer}}</td>
                <td>{{$address->city}}</td>
                <td>{{$address->street_or_district}}</td>
                <td>{{$address->house_number}}</td>
                <td>{{$address->floor}}</td>
                <td>{{$address->flat_number}}</td>
                <td>{{$address->intercom_code}}</td>
                <td>{{$address->customer_id}}</td>
                <td>{{$address->created_at}}</td>
                </tr>
            @endforeach
        </table>
        @endif
    </div>
</body>

</html>
