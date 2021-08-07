<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="http://tetsuo-travis.com/web_stuff/twitter_clone/">Tetsuo's Twitter</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link" href="?page=timeline">Your Timeline</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="?page=yourtweets">Your Tweets</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="?page=publicprofiles">Public Profiles</a>
                </li>
            </ul>
            <form class="d-flex">
                <button class="btn btn-outline-success" type="submit">Login/Sign-Up</button>
            </form>
            </div>
        </div>
    </nav>