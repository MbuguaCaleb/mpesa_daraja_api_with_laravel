<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mastering Mpesa Daraja Api</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-sm-8 mx-auto">

                <div class="card">
                    <div class="card-header">
                        Obtain Access Token
                    </div>

                    <div class="card-body">
                        <h4 id="access_token"></h4>

                        <button id="getAccessToken" class="btn btn-primary">Request Access Token</button>
                    </div>
                </div>

                <div class="card mt-5">
                    <div class="card-header">
                        Register URLs
                    </div>

                    <div class="card-body">
                        <button type="submit" class="btn btn-primary">

                            Register URLs
                        </button>
                    </div>

                </div>

                <div class="card mt-5">
                    <div class="card-header">
                        Simulate Transaction
                    </div>

                    <div class="card-body">
                        <form action="">
                            @csrf
                            <div class="form-group">

                                <label for="amount">Amount</label>
                                <input type="number" name="amount" id="amount" class="form-control">

                            </div>

                            <div class="form-group">

                                <label for="account">Account</label>
                                <input type="text" name="account" id="account" class="form-control">

                            </div>
                            <button class="btn btn-primary">Simulate Payment</button>
                        </form>
                    </div>
                </div>

            </div>


        </div>
    </div>

    <script src="{{asset('js/app.js')}}">
    </script>
    <script>
        document.getElementById('getAccessToken').addEventListener('click',(event)=>{
            event.preventDefault();
            axios.post('/get-token').then((response)=>{
                console.log(response.data)
                document.getElementById('access_token').innerHTML = response.data.access_token
            }).catch((error)=>
            console.log(error))
        })
    </script>
</body>

</html>