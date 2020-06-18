<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/contact/css/style.css')}}">
    <title>Contact Page</title>
</head>
<body>
    <h1>MESSAGE US</h1>
    <form action="{{url('/contact')}}" method="post" class="form-horizontal">
     
        <input type="text" name="name" placeholder="Your name please" class="form-control">
        <input type="email" name="email" placeholder="Your valid email" class="form-control">
        <textarea class="form-control" name="message" cols="30" rows="10" style="resize: none;" placeholder="Your message here..."></textarea>
        <input class="btn btn-primary" type="submit" name="submit" value="submit">
        
    </form>
  <!--   <script type="text/javascript" src="{{asset('vendor/contact/index.js')}}"></script> -->
</body>
</html>
