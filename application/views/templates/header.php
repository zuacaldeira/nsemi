<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Nsemi Image Processing</title>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" />
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
          
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/style.css'; ?>" />

   
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js" type="text/javascript"></script>

    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea'
        });

    </script>

    <script src="<?php echo base_url().'assets/js/nsemi.js'; ?>"></script>

    <script src="<?php echo base_url().'assets/js/page_background.js'; ?>"></script>


</head>

<body class="container-fluid m-0 p-0 bg-transparent" style="min-height: 100vh;">
    <?php 
        $username = $this->session->userdata('username');
    ?>
    <header class="container-fluid shadow">
        <nav class="navbar navbar-expand-lg container">
            <a class="navbar-brand shadow pb-0 h1 btn btn-sm" href="#">Nsemi</a>

            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link btn" href="<?php echo base_url();?>home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn" href="<?php echo base_url();?>gallery">Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn" href="<?php echo base_url();?>tools">Tools</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn" href="<?php echo base_url();?>news">News</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <?php if($username != null): ?>
                <li id="logout" class="nav-item">
                    <a class="btn btn-sm btn-danger" href="<?php echo base_url();?>logout">Logout</a>
                </li>
                <?php else: ?>
                <li id="login" class="nav-item mr-1">
                    <a class="btn btn-sm btn-outline-success" href="<?php echo base_url();?>login">Login</a>
                </li>
                <li id="register" class="nav-item">
                    <a class="btn btn-sm btn-outline-warning" href="<?php echo base_url();?>register">Register</a>
                </li>
                <?php endif; ?>

            </ul>
        </nav>
    </header>
    <main class="container text-light" style="min-height:80vh;">
