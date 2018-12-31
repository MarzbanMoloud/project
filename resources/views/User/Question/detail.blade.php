<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    </head>
    <body style="direction: rtl">
       <div>
           <form action="{{ route('saveQuestion') }}" method="POST">
               @csrf

               <div class="form-group col-md-4">
                   <label for="title">عنوان</label>
                   <input type="text" class="form-control" id="title" name="title">
               </div>

               <div class="form-group col-md-4">
                   <label for="description">سوال</label>
                   <textarea class="form-control" name="description" id="description"  cols="30" rows="3"></textarea>
               </div>

               <div class="form-group">
                   <input class="btn btn-primary" type="submit" value="ارسال">
               </div>
           </form>
       </div>
    </body>
</html>
