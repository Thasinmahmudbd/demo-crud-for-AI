@extends('frame')





@section('title')

    <!-- Title -->
    <title>CRUD - Products</title>

@endsection





@section('container')


    @if(session('actionType')=='insert')

        <!-- Create new product -->

        <h3 class="p_0 mb_1">Add Products</h3>


        <form action="{{url('/add/product')}}" method="post"  enctype="multipart/form-data">
        @csrf

        <div class="itemInfo">

            <div>
                <label for="category_id">Category</label>
                <select class="p_0_h fSize_1 m_0 cusInp" name="category_id" id="category_id" required>
                    <option value="">Select category</option>
                    @foreach($category as $list)
                    <option value="{{$list->id}}">{{$list->category}}</option>
                    @endforeach
                </select>
            </div>


            <div>
                <label for="sub_category_id">Sub Category</label>
                <select class="p_0_h fSize_1 m_0 cusInp" name="sub_category_id" id="sub_category_id" required>
                    <option value=""></option>
                </select>
            </div>


            <div>
                <label for="name">Product Name</label>
                <input  class="p_0_h fSize_1 m_0 cusInp" type="text" name="name" required>
            </div>


            <div>
                <label for="product_prize">Product Price</label>
                <input  class="p_0_h fSize_1 m_0 cusInp" type="number" name="product_prize" required>
            </div>


            <div>
                <label for="product_image">Product Main Image</label>
                <input class="fName" type="file" name="product_image" id="product_image" required>
            </div>


            <div>
                <label for="product_image">Multiple Images</label>
                <input class="fName" type="file" name="multiple_image[]" id="multiple_image" Multiple required>
            </div>

        </div>

        <p>Attributes:</p>

        <div class="disGrid gridCol_1_size_1 gridGap_h" id="attributes">

            <div class="disGrid gridCol_5_size_1 gridGap_h">

                <div class="disGrid">
                    <label for="sku">SKU</label>
                    <input  class="p_0_h fSize_1 m_0 cusInp content--w" type="text" name="sku[]" required>
                </div>

                <div class="disGrid">
                    <label for="size">Size</label>
                    <input  class="p_0_h fSize_1 m_0 cusInp" type="text" name="size[]" required>
                </div>

                <div class="disGrid">
                    <label for="quantity">Quantity</label>
                    <input  class="p_0_h fSize_1 m_0 cusInp" type="number" name="quantity[]" required>
                </div>

                <div class="disGrid">
                    <label for="price">Price</label>
                    <input  class="p_0_h fSize_1 m_0 cusInp" type="number" name="price[]" required>
                </div>

                <div class="disGrid">
                    <span></span>
                    <button class="pendingBtnR curPointer addMore">Add More</button>
                </div>

            </div>

        </div>

            @error('sliderImage')
				<span class="highlightDanger w_100Per txtCenter">{{$message}}</span>
			@enderror

            <input class="successBtnR fSize_1 lato disGrid m_a w_100Per" value="Insert" type="submit">

        </form>




    @else



        <!-- Edit product -->

        <h3 class="p_0 mb_1">Edit Products</h3>


        <form action="{{url('/edit/product/'.$product->id)}}" method="post"  enctype="multipart/form-data">
        @csrf

        <div class="itemInfo">

            <div>
                <label for="category_id">Category</label>
                <select class="p_0_h fSize_1 m_0 cusInp" name="category_id" id="category_id" required>
                    @foreach($category as $list)
                        @if(session('selectedCategoryID')==$list->id)
                            <option value="{{$list->id}}" selected>{{$list->category}}</option>
                        @else
                            <option value="{{$list->id}}">{{$list->category}}</option>
                        @endif
                    @endforeach
                </select>
            </div>


            <div>
                <label for="sub_category_id">Sub Category</label>
                <select class="p_0_h fSize_1 m_0 cusInp" name="sub_category_id" id="sub_category_id" required>
                    <option value="{{session('selectedSubCategoryID')}}">{{session('selectedSubCategory')}}</option>
                </select>
            </div>


            <div>
                <label for="name">Product Name</label>
                <input  class="p_0_h fSize_1 m_0 cusInp" type="text" name="name" value="{{$product->name}}" required>
            </div>


            <div>
                <label for="product_prize">Product Price</label>
                <input  class="p_0_h fSize_1 m_0 cusInp" type="number" name="product_prize" value="{{$product->product_prize}}" required>
            </div>


            <div>
                <label for="product_image">Product Main Image</label>
                <input class="fName" type="file" name="product_image" id="product_image">
            </div>

            <div>
                <label for="product_image">Multiple Images</label>
                <input class="fName" type="file" name="multiple_image[]" id="multiple_image" Multiple>
            </div>

        </div>

        <p>Attributes:</p>

        <div class="disGrid gridCol_1_size_1 gridGap_h" id="attributes">

            @foreach($attribute as $list)
            <div class="disGrid gridCol_5_size_1 gridGap_h">

                <div class="disGrid">
                    <label for="sku">SKU</label>
                    <input  class="p_0_h fSize_1 m_0 cusInp content--w" type="text" name="sku[]" value="{{$list->sku}}" required>
                </div>

                <div class="disGrid">
                    <label for="size">Size</label>
                    <input  class="p_0_h fSize_1 m_0 cusInp" type="text" name="size[]" value="{{$list->size}}" required>
                </div>

                <div class="disGrid">
                    <label for="quantity">Quantity</label>
                    <input  class="p_0_h fSize_1 m_0 cusInp" type="number" name="quantity[]" value="{{$list->quantity}}" required>
                </div>

                <div class="disGrid">
                    <label for="price">Price</label>
                    <input  class="p_0_h fSize_1 m_0 cusInp" type="number" name="price[]" value="{{$list->price}}" required>
                </div>

                <div class="disGrid">
                    <span></span>
                    <button class="dangerBtnR curPointer remove">Remove</button>
                </div>

            </div>
            @endforeach

        </div>

        <button class="pendingBtnR curPointer addMore">Add More</button>

            @error('sliderImage')
				<span class="highlightDanger w_100Per txtCenter">{{$message}}</span>
			@enderror

            <input class="successBtnR fSize_1 lato disGrid m_a w_100Per" value="Update" type="submit">

        </form>

    @endif










    <!-- jQuery -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
        jQuery(document).ready(function(){
            jQuery('#category_id').change(function(){
                let category_id = jQuery(this).val();
                jQuery.ajax({
                    url:'/get/dependent/sub/category',
                    type:'post',
                    data:'category_id='+category_id+'&_token={{csrf_token()}}',
                    success:function(result){
                        jQuery('#sub_category_id').html(result)
                    }
                });
            });
        });
    </script>

    <script>

        $(document).ready(function(){
            $(".addMore").click(function(e){
                e.preventDefault();
                $("#attributes").prepend(`<div class="disGrid gridCol_5_size_1 gridGap_h">
                
                <div class="disGrid">
                    <label for="sku">SKU</label>
                    <input  class="p_0_h fSize_1 m_0 cusInp content--w" type="text" name="sku[]" required>
                </div>

                <div class="disGrid">
                    <label for="size">Size</label>
                    <input  class="p_0_h fSize_1 m_0 cusInp" type="text" name="size[]" required>
                </div>

                <div class="disGrid">
                    <label for="quantity">Quantity</label>
                    <input  class="p_0_h fSize_1 m_0 cusInp" type="number" name="quantity[]" required>
                </div>

                <div class="disGrid">
                    <label for="price">Price</label>
                    <input  class="p_0_h fSize_1 m_0 cusInp" type="number" name="price[]" required>
                </div>

                <div class="disGrid">
                    <span></span>
                    <button class="dangerBtnR curPointer remove">Remove</button>
                </div>
                </div>`)
            });

            $(document).on('click', '.remove', function(e){
                e.preventDefault();
                let row_item = $(this).parent().parent();
                $(row_item).remove();
            });
        });

    </script>

@endsection