<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.css" integrity="sha512-VcyUgkobcyhqQl74HS1TcTMnLEfdfX6BbjhH8ZBjFU9YTwHwtoRtWSGzhpDVEJqtMlvLM2z3JIixUOu63PNCYQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <?php
        require_once("templates/header.php")
    ?>
        <div id="main-container" class="container-fluid">

            <div class="col-md-12">
                <section class="auth-row">
                    
                    <div>
                        <div class="col-md-4" id="login-container">
                            <h2> Entrar </h2>
                        </div>
                        <form action="" method="POST">
                        
                            <input type="hidden" name="type" value="login">
                            <div class="form-group">
                                <label for="email"> Email: </label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Digite seu email">
                            </div>
                            <div class="form-group">
                                <label for="password"> password: </label>
                                <input type="text" class="form-control" id="password" name="password" placeholder="Digite seu password">
                            </div>
                            <button  class="btn"  id="card-btn" type="submit">
                                Entrar
                            </button>
                    </div>

                    </form>


                    <div class="col-md-4" id="login-container">
                        <h2> Criar Conta </h2>

                        <form action="auth-process.php" method="POST">

                        <input type="hidden" name="type" value="register">

                        <div class="form-group">
                            <label for="email"> email: </label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email">
                        </div>

                        <div class="form-group">
                            <label for="email"> nome: </label>
                            <input type="text" class="form-control" id="nome" name="name" placeholder="Digite seu nome">
                        </div>

                        <div class="form-group">
                            <label for="lastname"> lastname: </label>
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Digite seu lastname">
                        </div>

                        <div class="form-group">
                            <label for="password"> password: </label>
                            <input type="text" class="form-control" id="password" name="password" placeholder="Digite seu password">
                        </div>


                        <div class="form-group">
                            <label for="confirmpassword"> confirm password: </label>
                            <input type="text" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Digite seu confirm-password">
                        </div>

                        <button  class="btn"  id="card-btn" type="submit">
                            Criar Conta
                        </button>

                        </form>


                    </div>
                </div>
        </section>


        </div>

    <?php
        require_once("templates/footer.php")
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.js" integrity="sha512-lsA4IzLaXH0A+uH6JQTuz6DbhqxmVygrWv1CpC/s5vGyMqlnP0y+RYt65vKxbaVq+H6OzbbRtxzf+Zbj20alGw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>