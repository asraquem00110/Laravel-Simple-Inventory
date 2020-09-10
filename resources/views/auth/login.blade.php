@php
use App\Models\Setting\getCompany;
$company = new getCompany;
@endphp
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Online Shopping">
    <meta name="author" content="asraquem">
    <meta name="keyword" content="Dashboard,Shopping,Management">
	 <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

	<link rel="stylesheet" type="text/css" href="{{ asset('custom/css/fontawesome/css/all.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('custom/css/main.css') }}">
	<!-- <link rel="stylesheet" type="text/css" href="{{ asset('custom/css/admin/main.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('custom/css/admin/dashboard.css') }}">
 -->
	<script src="{{ asset('custom/css/fontawesome/js/all.js') }}"></script>

	 <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

	
<style type="text/css">

html,body {
background-image: url("{{asset('images/bgtest.png')}}");
background-image: url("{{asset('images/newbg.png')}}") !important;
background-position: center;
background-repeat: no-repeat;
background-size: cover;
font-family: 'calibri';
margin: 0;
padding: 0;
height: 100%;
    /*backdrop-filter: blur(2px);*/
               /* backdrop-filter: contrast(50%);*/
}

#logindiv {
position: absolute;
top: 50%;
left: 50%;
transform: translate(-50%,-50%);
height: 70%;
width: 60%;
background: black;
border-radius: 20px;
box-shadow: 1px 1px 5px 1px black;
}

#systemname {

background: #3071A9;
border-top-left-radius: 20px;
border-bottom-left-radius: 20px;
}

#logindetails{

background-image: url("{{asset('images/bg2.jpg')}}");
background-image: url("{{asset('images/new.jpg')}}") !important;
background-position: center;
background-repeat: no-repeat;
background-size: cover;
border-top-right-radius: 20px;
border-bottom-right-radius: 20px;
}

.grid-container{
grid-gap: 0;
}

.form-control {
border-radius: 2px;
}


#systemname div h1 {
color: #D4AF37;
font-size: 30pt;
font-weight: bold;
}

.loginform {
position: absolute;
top: 50%;
left: 50%;
transform: translate(-50%,-50%);
}

button#loginbutton {
background: #D4AF37;
color: white;
}



#systemname {

background: #0C0A03;
}

.grid-container{
grid-gap: 0;
}

@media (max-width: 1000px){
#systemname {
display: block;
grid-column: span 12;
border-top-right-radius: 20px;
border-bottom-right-radius: 20px;
}

#logindetails {
grid-column: span 12;
border-top-left-radius: 20px;
border-bottom-left-radius: 20px;
display: none;
}


#loginlogo {
display: inline !important;
}

#logo2 {
display: none !important;
}

}

.form-control {
    padding: 15px;
    font-size: 12pt;
}

#systemname form {
    margin-top: 40px;
}

</style>


</head>
<body>


	<div id="logindiv" class="grid-container" style="">
        
    <div id="systemname" class="grid-col-5" style="position:relative;background:white;padding: 40px;">
            <span style="font-size: 28pt;font-weight: bold;color: #70B1C7">INVENTORY</span>&nbsp;<span style="font-size: 18pt;font-weight: bold;color: #FEC178">SYSTEM</span>
            <p style="font-size: 12pt;font-weight: bold;color: #727271;">&nbsp;System for WareHouse Management</p>

    
            <form method="POST" action="{{ route('login') }}">
                        @csrf
                <!-- <div style="text-align: center;">
                     <img src="{{asset('images/userlogo.png')}}" style="width: 60px;height: 60px;border-radius: 50%;border: 1px solid black;">
            </div> -->
            <div class="form-group">
                <label style="font-weight: bold;font-size: 10pt;font-style: initial;color: #70B1C7">Email Address</label>
                     <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                         @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
             </div>
            <div class="form-group">
               <label style="font-weight: bold;font-size: 10pt;font-style: initial;color: #70B1C7">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                       @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
            </div>
          
            <div class="form-group">
                <button type="submit" style="border: none;border-radius: 5px;border-style: none;cursor:pointer;width: 100%;background: #FEC178;color: white;font-size: 14pt;font-weight: bold;" class="">LOGIN</button>
            </div>
    
          
             </form>

             <span style="position: absolute;left: 40px;bottom: 20px;font-size: 8pt;font-weight: bold;font-style: italic;color: dimgray;">Copyright &copy; 2020-{{ date('Y',time())}} <a href="javascript:void(0)">{{$company->execute()[0]->value}}</a>.</strong> All rights reserved.</span>

    </div>


    <div id="logindetails" class="grid-col-7" style="position:relative;">

      <!--       <div class="loginform" style="text-align:center;position: relative; top: 50%;padding: 0px 50px;">
                
            </div>
 -->
        <img src="{{asset('/images/company/'.$company->execute()[1]->value.'')}}" style="position: absolute;right: 10px;bottom: 10px;width: 200px;height: 100px;">

    </div>

</div>




<script>
    
    $("#email").val("admin@gmail.com")
    $("#password").val("password")

</script>

</body>
</html>
