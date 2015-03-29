 




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Blog50</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/style.css" />

  
  </head>

  <body>
    <header>
      <div class="container">
        <div class="media-left">
          @yield('header-right')
        </div>

    <a href="/" class="navbar-brand">同人论坛</a>

      </div>
    </header>

    <div class="main">
      <div class="container">
          @yield('content')
      </div>
    </div>

  </body>
</html>


