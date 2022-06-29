<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Your description.">
    <meta name="keywords" content="tag, tag, tag">
    <meta name="author" content="Your Name">
    <!-- Title -->
    <title>Admin Login</title>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="#">
    <link rel="icon" type="image/png" sizes="32x32" href="#">
    <link rel="icon" type="image/png" sizes="16x16" href="#">
    <link rel="manifest" href="#">
    <!-- CDN Development -->
    <link rel="stylesheet" href="https://raw.githack.com/Thasinmahmudbd/TcSS-Framework/Thasin/dist/css/tcss.min.css">
    <!-- CDN Backup -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/Thasinmahmudbd/TcSS-Framework/dist/css/tcss.min.css">
    <!-- CDN Production (current version)-->
    <link rel="stylesheet" href="https://rawcdn.githack.com/Thasinmahmudbd/TcSS-Framework/8272c261b90f1bd691ade6402fa9f73ada36fa12/dist/css/tcss.min.css">
    <!-- Script -->
    <script defer src="#"></script>
</head>

<body>

    <!--Session message-->

    @if(session('msgHook')=='green' && session()->has('msg'))

    <p class="highlightSuccess w_100Per txtCenter"> {{session('msg')}} </p>

    @elseif(session('msgHook')=='yellow' && session()->has('msg'))

    <p class="highlightAlert w_100Per txtCenter"> {{session('msg')}} </p>

    @elseif(session('msgHook')=='red' && session()->has('msg'))

    <p class="highlightDanger w_100Per txtCenter"> {{session('msg')}} </p>

    @endif

    <div class="disGrid gridGap_1 w_40Per m_a">

        <p>Register</p>

        <form action="{{url('/register/user')}}" method="post"  class="disGrid gridGap_1">
        @csrf

            <div class="disGrid gridCol_2_size_3_7">
                <label for="name">Email</label>
                <input  class="p_0_h fSize_1 m_0 cusInp" type="email" name="email" value="{{old('email')}}">
            </div>

            @error('email')
                <span class="highlightAlert w_100Per txtCenter lato fSize_1">{{$message}}</span>
            @enderror

            <div class="disGrid gridCol_2_size_3_7">
                <label for="name">New Password</label>
                <input  class="p_0_h fSize_1 m_0 cusInp" type="password" name="password">
            </div>

            @error('password')
                <span class="highlightAlert w_100Per txtCenter lato fSize_1">{{$message}}</span>
            @enderror

            <div class="disGrid gridCol_2_size_3_7">
                <label for="name">Confirm Password</label>
                <input  class="p_0_h fSize_1 m_0 cusInp" type="password" name="confirmPassword">
            </div>

            @error('confirmPassword')
                <span class="highlightAlert w_100Per txtCenter lato fSize_1">{{$message}}</span>
            @enderror

            <input class="successBtnR fSize_1 lato disGrid m_a w_100Per" value="Register" type="submit">

        </form>

        <a class="link" href="{{url('/')}}">Have account login</a>

    </div>



</body>
</html>