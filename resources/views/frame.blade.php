<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Thasin Mahmud">

    <!-- title -->
    @section('title')
    @show

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
    
    <!-- style -->
    <link rel="stylesheet" href="{{asset('css/tables.css')}}">
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <link rel="stylesheet" href="{{asset('css/global.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive/index_res.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive/global_res.css')}}">

    <!-- scripts -->
    <script defer src="{{asset('scripts/ham.js')}}"></script>
    <script defer src="{{asset('scripts/triggerClick.js')}}"></script>
    <script defer src="{{asset('scripts/imageViewer.js')}}"></script>

</head>

<body class="lato">

    <div class="navType_2">
    
        <!-- Text Logo. -->
        <p class="txtLogo">Admin</p>

        <!-- Search Form. -->
        <span></span>
    
        <!-- Links. -->
        <div class="mainLinks">
            <a class="hamburger" onclick="ham()" href="#"><i class="fas fa-bars"></i></a>
        </div>
    
    </div>

    <!-- drop down links. -->
    <div class="hamOverlay gridCol_3_size_1" id="ham">
        <li class="hamNavs"><a href="{{url('/insert/product')}}">Add Product</a></li>
        <li class="hamNavs"><a href="{{url('/show/all/products')}}">Product List</a></li>
        <li class="hamNavs"><a href="{{url('/show/all/categories')}}">Category</a></li>
        <li class="hamNavs"><a href="{{url('/show/all/sub/categories')}}">Sub Category</a></li>
        <li class="hamNavs"><a href="{{url('/logout')}}">Logout</a></li>
    </div>




    <div class="fr2"> <!--Starting: frame no.2-->
    
        <div class="fr2Ls_1 bgShadowWhite"> <!--Starting: left side - fixed-->
    
            <ul> <!--Starting: side panel - main links-->
                <li>
                    <a class="fr2Ls_btn hoverEff_3 borOnlyB borClrBlack borSize_1" href="{{url('/insert/product')}}">Add Product</a>
                </li>
                <li>
                    <a class="fr2Ls_btn hoverEff_3 borOnlyB borClrBlack borSize_1" href="{{url('/show/all/products')}}">Product List</a>
                </li>
                <li>
                    <a class="fr2Ls_btn hoverEff_3 borOnlyB borClrBlack borSize_1" href="{{url('/show/all/categories')}}">Category</a> 
                </li>
                <li>
                    <a class="fr2Ls_btn hoverEff_3 borOnlyB borClrBlack borSize_1" href="{{url('/show/all/sub/categories')}}">Sub Category</a> 
                </li>
                <li>
                    <a class="fr2Ls_btn hoverEff_3 borOnlyB borClrBlack borSize_1" href="{{url('/logout')}}">Logout</a> 
                </li>
            </ul> <!--Ending: side panel - main links-->
    
        </div> <!--Ending: left side - fixed-->
    
        <div class="fr2Rs_1"> <!--Starting: right side - scrollable-->
    
            <span> <!--Gap balancer for nav-->
                <p>Gap for navbar.</p>
            </span>
    
            <div> <!--Content container-->








            <!--Session message-->

            @if(session('msgHook')=='green' && session()->has('msg'))

            <p class="highlightSuccess w_100Per txtCenter"> {{session('msg')}} </p>

            @elseif(session('msgHook')=='yellow' && session()->has('msg'))

            <p class="highlightAlert w_100Per txtCenter"> {{session('msg')}} </p>

            @elseif(session('msgHook')=='red' && session()->has('msg'))

            <p class="highlightDanger w_100Per txtCenter"> {{session('msg')}} </p>

            @endif





<!-- container -->
@section('container')
@show





            </div>
    
        </div> <!--Ending: right side - scrollable-->
    
    </div> <!--Ending: frame no.2-->



</body>
</html>