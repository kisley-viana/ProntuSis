<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <!-- CSS BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- FONTAWESOME -->
    <link href="/fontawesome-free-5.15.1-web/css/all.css" rel="stylesheet">

    <title>SisProntu - Login</title>
</head>
<body style="background-color: dodgerblue;">

    <div class="container-fluid" style="width: 30%; padding: 3%; background-color: white; border: solid; border-color: gray; border-radius: 5%; margin-top: 5%;">
        <img class="img-fluid rounded mx-auto d-block" src="/img/logo.png" alt="logo" style="width: 10rem">
        <h3 align="center">ProntuSis</h3>
        <form>
        <div class="form-group">
            <label for="email"><i class="fas fa-at"></i> E-mail:</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="senha"><i class="fas fa-key"></i> Senha:</label>
            <input type="password" class="form-control" id="senha">
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Logar</button>
        </form>
    </div>



    <!-- SCRIPTS BOOTSTRAP -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>
</html>