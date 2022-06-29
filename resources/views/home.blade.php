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
                    @foreach($category as $list)
                    <option value="{{$list->id}}">{{$list->category}}</option>
                    @endforeach
                </select>
            </div>


            <div>
                <label for="sub_category_id">Sub Category</label>
                <select class="p_0_h fSize_1 m_0 cusInp" name="sub_category_id" id="sub_category_id" required>
                    @foreach($subCategory as $list)
                    <option value="{{$list->id}}">{{$list->sub_category}}</option>
                    @endforeach
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

            <div class="disGrid gridCol_4_size_1 gap_1" id="attributes">

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

            </div>

            <span class="pendingBtn curPointer" onclick="add_more_fields()">add more</span>

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
                    @foreach($sub_category as $list)
                        @if(session('selectedSubCategoryID')==$list->id)
                            <option value="{{$list->id}}" selected>{{$list->sub_category}}</option>
                        @else
                            <option value="{{$list->id}}">{{$list->sub_category}}</option>
                        @endif
                    @endforeach
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

            <div class="disGrid gridCol_4_size_1 gap_1" id="attributes">

                <!-- append will be here -->

            </div>

            <span class="pendingBtn curPointer" onclick="add_more_fields()">add attribute</span>

            @error('sliderImage')
				<span class="highlightDanger w_100Per txtCenter">{{$message}}</span>
			@enderror

            <input class="successBtnR fSize_1 lato disGrid m_a w_100Per" value="Update" type="submit">

        </form>

    @endif




@endsection