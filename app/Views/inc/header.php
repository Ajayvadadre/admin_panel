<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="<?php echo base_url('bootstrap/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('selecto/selecto.css') ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        html {
            background-color: rgb(226, 226, 226);

        }

        .navbar {
            background-color: rgb(255 255 255);
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .nav-link {
            color: grey;
        }

        .collapse {
            margin-left: 9rem;
        }


        .div-breadcrumbs {
            width: 100%;
        }

        .div-breadcrumbs .breadcrumb {
            background-color: #f3f3f3;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-decoration: none;
        }

        .div-breadcrumbs .breadcrumb li a {
            color: #6c6c6c
        }

        .dropdown:hover>.dropdown-menu {
            display: block;
        }

        .dropdown>.dropdown-toggle:active {
            /*Without this, clicking will make it sticky*/
            pointer-events: none;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark pt-3 px-0 pb-0">
        <div class="main-navbar px-4 pt-3 pb-2 w-100 d-flex justify-content-between ">
            <img src="https://res.cloudinary.com/df0ifelxk/image/upload/v1734428333/slashLogo_suya7r.png" height="80px" width="80px" alt="">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mt-3" id="navbarSupportedContent">
                <ul class="navbar-nav ">
                    <li class="nav-item active">
                        <a class="nav-link " style="color: #6c6c6c; " href="#"> <i class="fas fa-globe-africa"></i> Dashboard <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link   ml-3" style="color: #6c6c6c; " href="#"> <i class="fas fa-comment-alt"></i> Conversations</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    ml-3" style="color: #6c6c6c; " href="#"> <i class="fas fa-video"></i> Live</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    ml-3" style="color: #6c6c6c; " href="#"> <i class="fas fa-chart-bar"></i> Reports</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    ml-3" style="color: #6c6c6c; " href="#"> <i class="fas fa-address-book"></i> Contacts</a>
                    </li>
                    <li class="nav-item ">
                        <div class="dropdown h-100 ml-3 mt-2">
                            <button data-mdb-button-init
                                data-mdb-ripple-init data-mdb-dropdown-init
                                class=" bg-transparent p-0 border-0 dropdown-toggle"
                                type="button"
                                id="dropdownMenuButton"
                                data-mdb-toggle="dropdown"
                                style="color: #6c6c6c;"
                                aria-expanded="false">
                                <i class="fas fa-cogs"></i> Operations
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="/Users">Users</a></li>
                                <li><a class="dropdown-item" href="/Campaigns">Campaigns</a></li>
                                <li><a class="dropdown-item" href="/Chatcontroller/ShowChat">Chat</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    ml-3" style="color: #6c6c6c; " href="#"> <i class="fas fa-cog"></i> Advanced settings</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    ml-3" style="color: #6c6c6c; " href="#"> <i class="fas fa-file-alt"></i> Custom Reports</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="div-breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item "><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                </ol>
            </nav>
        </div>
    </nav>