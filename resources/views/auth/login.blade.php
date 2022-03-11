<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/login.css" rel="stylesheet">
    <title>Test Caisse | Tinah</title>
</head>
<body>
    <div class="container">
        <form method="POST" class="container_body" action="/login"> 
            @csrf
            <div class="head">
                <img src="/images/logo-black.png" />
                <h1>Caisse</h1>
            </div>
            @if (Session::get('error'))
                <span class="error_msg"> Adresse e-mail et/ou mot de passe invalide </span>
            @endif
            <div class="form-group">
                <label> Adresse e-mail (*) </label>
                <input class="form-control" type="email" name="email" placeholder="Entrez votre adresse e-mail"/>
            </div>
            <div class="form-group">
                <label> Mot de passe (*) </label>
                <input class="form-control" type="password" placeholder="Mot de passe" name="password" />
            </div>
            <button class="btn btn-secondary"> Connexion </button>
        </form>
        </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</html>

