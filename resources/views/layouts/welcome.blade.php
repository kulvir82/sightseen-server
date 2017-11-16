<html >
    <head>
      <meta name="csrf-token" content="{{ csrf_token() }}"/>
      <link href="{{ mix('css/app.css') }}" rel="stylesheet">
      <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
      <script src="{{ mix('/js/main.js') }}"></script>
    </head>
    <body>
      <div class="container" id="app">
      </div>
    </body>
      <script src="{{ mix('/js/app.js') }}"></script>
</html>
