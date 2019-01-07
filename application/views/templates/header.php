<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Nsemi Image Processing</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/style.css'; ?>" />

    <script src="https://code.jquery.com/jquery-3.3.1.min.js">
    </script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js">
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js" type="text/javascript">
    </script>
    
    <script src="<?php echo base_url().'assets/js/nsemi.js'; ?>"></script>

    <script src="<?php echo base_url().'assets/js/page_background.js'; ?>"></script>
    
    
</head>

<body class="container-fluid m-0 p-0 "  style="min-height: 100vh;">
   <?php 
        $username = $this->session->userdata('username');
    ?>
    <header class="container-fluid pt-3 shadow">
        <nav class="container">
            <div class="row">
                <span class="col-auto nav-brand text-secondary">Nsemi</span>
                <ul class="col list-unstyled">
                    <li class="nav-item d-inline"><a href="<?php echo base_url();?>home">Home</a></li>
                    <li class="nav-item d-inline"><a href="<?php echo base_url();?>gallery">Gallery</a></li>
                    <li class="nav-item d-inline"><a href="<?php echo base_url();?>tools">Tools</a></li>
                    <li class="nav-item d-inline"><a href="<?php echo base_url();?>news">News</a></li>
                </ul>
                <ul class="col list-unstyled text-right">
                   <?php if($username != null): ?>
                        <li id="logout" class="d-inline"><a class="btn btn-sm btn-danger" href="<?php echo base_url();?>logout">Logout</a></li>
                    <?php else: ?>
                        <li id="login" class="d-inline"><a class="btn btn-sm btn-success" href="<?php echo base_url();?>login">Login</a></li>
                        <li id="register"  class="d-inline"><a class="btn btn-sm btn-success" href="<?php echo base_url();?>register">Register</a></li>                    
                    <?php endif; ?>
                    
                </ul>
            </div>
        </nav>
    </header>
    <main class="container text-light" style="min-height:80vh;">

