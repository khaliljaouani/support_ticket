<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css"
  rel="stylesheet"
/>

</head>
<body class="bg-light">
<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10 mt-5 pt-5">
                <div class="row z-depth-3">
                    <div class="col-sm-4 bg-info rounded-left">
                        <div class="card-block text-center text-white">
                            <i class="fas fa-user-tie fa-7x mt-5"></i>
                            <h2 class="font-weight-bold mt-4"><?php echo $data['user']->firstname.' '.$data['user']->lastname; ?></h2>
                            <p><?php echo $data['user']->type; ?></p>
                            <i class="far fa-edit fa-2x mb-4"></i>
                        </div>
                    </div>
                    <div class="col-sm-8 bg-white rounded-right">
                        <h3 class="mt-3 text-center mb-4">Information</h3>
                        <hr class="badge-primary mb-4">
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <p class="font-weight-bold mb-1">Nom : </p>
                                <h6 class="text-muted"><?php echo $data['user']->firstname; ?></h6>
                            </div>
                            <div class="col-sm-6">
                                <p class="font-weight-bold mb-1">Prenom :</p>
                                <h6 class="text-muted"><?php echo $data['user']->lastname; ?></h6>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-sm-6">
                                <p class="font-weight-bold mb-1">Email: </p>
                                <h6 class="text-muted"><?php echo $data['user']->email; ?></h6>
                            </div>
                        </div>
                        <hr class="bg-primary ">
                            <ul class="list-unstyled d-flex justify-content-center mt-4">
                                <li><a href="#"><i class="fab fa-facebook-f px-3 h4 text-info"></i></a></li>
                                <li><a href="#"><i class="fab fa-youtube px-3 h4 text-info"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter px-3 h4 text-info"></i></a></li>
                            </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php' ?>  
</body>
</html>