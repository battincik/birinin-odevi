<?php include "ayar.php"; ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Blog</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link href="css/styles.css" rel="stylesheet" />
    </head>

    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="/">Blog</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#">Anasayfa</a></li>
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="/kayit.php">Kayıt Ol</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page header with logo and tagline-->
        <header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">Welcome to Blog Home!</h1>
                    <p class="lead mb-0">A Bootstrap 5 starter layout for your next blog homepage</p>
                </div>
            </div>
        </header>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">
                     <div class="card mb-4">
                            <div class="card-body">
                                <div class="table table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">id</th>
                                                <th scope="col">Başlık</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sorgu = $db->prepare("SELECT * FROM posts");
                                            $sorgu->execute();
                                            $posts = $sorgu->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($posts as $post) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $post["id"]; ?></td>
                                                    <td><?php echo $post["title"]; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <?php if (!isset($_SESSION["username"])) { ?>  
                        <div class="card mb-4">
                            <div class="card-header">Giriş yap</div>
                            <div class="card-body">
                                <form method="POST" action="giris.php">
                                    <div class="form-group mb-2">
                                        <label for="username">Kullanıcı adı</label>
                                        <input type="username" class="form-control" id="username" placeholder="Kullanıcı Adı" name="username">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="password">Şifre</label>
                                        <input type="password" class="form-control" id="password" placeholder="Şifre" name="password">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Giriş yap</button>
                                </form>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="card mb-4">
                            <div class="card-header">Giriş yap</div>
                            <div class="card-body">
                                <div class="alert alert-success" role="alert">
                                    Hoşgeldin <b><?php echo $_SESSION["username"]; ?></b>
                            </div>
                            <a href="/cikis.php" class="btn btn-primary">Çıkış yap</a>
                            <?php
                            $sql = "SELECT * FROM users WHERE username = :username";
                            $stmt = $db->prepare($sql);
                            $stmt->bindParam(':username', $_SESSION["username"], PDO::PARAM_STR);
                            $stmt->execute();
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            if ($row["admin"] == 1) { ?>
                                    <a href="/uyeler.php" class="btn btn-success">Üyeler</a>
                                    <a href="/yazilar.php" class="btn btn-success">Yazılar</a>
                            <?php } ?>
                            </div>
                            </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        </div>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>

</html>