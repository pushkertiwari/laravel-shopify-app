<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>My Test App</title>

        <!-- Latest compiled and minified CSS & JS -->
        <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <script src="//code.jquery.com/jquery.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    </head>
    <body>

       <div class="container">

       <div class="col-md-6 appBox col-md-offset-3">
       <h4><b>Please Enter your Shopify Store Name to install the app</b></h4>
       <form class="form account-form" method="POST" action="{{ url('/formsubmit') }}">
         {{ csrf_field() }}
         <div class="form-group">
           <div class="input-group">
             <span class="input-group-addon" id="basic-addon1">https://</span>
             <input type="text" class="form-control" id="storeName" name="storeName" value="{{ old('storeName') }}" placeholder="Add Store Name Here" tabindex="1">
              <span class="input-group-addon">.myshopify.com</span>
           </div>
           <span style="color:red;">{{ Session::get('error') }}</span>
         </div>
         <div class="form-group">
           <button type="submit" name="shopInstallation" id="shopInstallation" class="btn btn-primary btn-block btn-lg" tabindex="4">
             Install App Now <i class="fa fa-play-circle"></i>
           </button>
         </div>
       </form>
     </div>

       </div>

    </body>
</html>
