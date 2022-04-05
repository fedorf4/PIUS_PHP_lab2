<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab2 task1</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>

    <h1>Customers</h1>

    <form action="/customers" id="allcustomersfilter" method="GET">
        <div class="form-control">
            <label for="emailfilter" class="form__label">Is blocked:</label>
            <select name="is_blocked" selected={{$request->get('is_blocked')}}>
                <option value="">----</option>
                <option value="true">true</option>
                <option value="false">false</option>
            </select>
        </div>
        <div class="form-control">
            <label for="emailfilter" class="form__label">Email:</label>
            <input type="text" id="emailfilter" name="emailfilter" value={{$request->emailfilter}}> </input>
        </div>
        <div class="form-control">
            <label for="phonefilter" class="form__label">Phone:</label>
            <input type="text" id="phonefilter" name="phonefilter" value={{$request->get('phonefilter')}}> </input>
        </div>
        <div class="form-control">
            <label for="namefilter" class="form__label">Name:</label>
            <input type="text" id="namefilter" name="namefilter" value={{$request->namefilter}}> </input>
        </div>
        <button type="submit" class="btn btn-primary mb-2">Apply filter</button>
    </form>

    <div>
        @if (count($customers) === 0)
        <div style="font-style:italic;">
            There are no customers satisfying the specified parameters!
        </div>
        @else
        <table>
            <tr><th>id</th><th>Name</th><th>Surname</th><th>Is blocked</th><th>Phone</th><th>Email</th><th>Registration date</th></tr>          
            @foreach ($customers as $customer)
                <tr>
                <td>{{$customer->id}}</td>
                <td>{{$customer->name}}</td>
                <td>{{$customer->surname}}</td>
                <td>{{$customer->is_blocked}}</td>
                <td>{{$customer->phone}}</td>
                <td>{{$customer->email}}</td>
                <td>{{$customer->created_at}}</td>
                </tr>
            @endforeach
        </table>
        <!--{{$customers->links()}}!--> 
        @endif
        @if($page>1)
        <a href="/customers?page={{$page-1}}{{$stringrequest}}">prevpage</a>
        @endif
        {{$page}}
        @if(20<=count($customers))
        <a href="/customers?page={{$page+1}}{{$stringrequest}}">nextpage</a>
        @endif
    </div>
</body>

</html>
