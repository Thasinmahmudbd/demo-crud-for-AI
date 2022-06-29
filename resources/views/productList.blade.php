@extends('frame')





@section('title')

    <!-- Title -->
    <title>CRUD - Products</title>

@endsection





@section('container')






        <h3 class="p_0 mb_1">Existing Products</h3>


        @foreach($data as $list)

        <div class="border mb_1">

            <div class="gridCol_3_size_2_4_4 border">

                <img src="{{asset('media/product/'.$list->product_image)}}" alt="Upload Photo" class="placeholder_image">

                <div class="gridCol_2_size_5_5 border">
                    <p>Product Name:</p>
                    <p>{{$list->name}}</p>
                    <p>Product Category:</p>
                    <p>{{$list->category}}</p>
                    <p>Product Sub Category:</p>
                    <p>{{$list->sub_category}}</p>
                    <p>Product Price:</p>
                    <p>{{$list->product_prize}}</p>
                </div>

                <table class="tableBasicBlue w_100Per">

                    <tr>
                        <th width="20%" class="fSize_1">Sku</th>
                        <th width="20%" class="fSize_1">Size</th>
                        <th width="20%" class="fSize_1">Stock</th>
                        <th width="20%" class="fSize_1">Price</th>
                        <th width="20%" class="fSize_1">Delete</th>
                    </tr>

                    @foreach($attribute as $attr)

                        @if($list->id==$attr->product_id)
                        <tr>
                            <td width="20%" class="fSize_1">{{$attr->sku}}</td>
                            <td width="20%" class="fSize_1">{{$attr->size}}</td>
                            <td width="20%" class="fSize_1">{{$attr->quantity}}</td>
                            <td width="20%" class="fSize_1">{{$attr->price}}</td>
                            <td width="20%" class="fSize_1">
                                <a href="{{url('/delete/attribute/'.$attr->id)}}" class="dangerBtnR txtCenter">Delete</a>
                            </td>
                        </tr>
                        @endif

                    @endforeach

                </table>

            </div>


                <div class="gridCol_10_size_1 gridGap_1">
                    @foreach($gallery as $img)
                        @if($list->id==$img->product_id)
                        <div class="disGrid border">
                            <img src="{{asset('media/gallery/'.$img->image)}}" alt="" width="50px">
                            <a href="{{url('/delete/image/'.$img->id)}}" class="dangerBtnR txtCenter">delete Img</a>
                        </div>
                        @endif
                    @endforeach
                </div>


                <div class="gridCol_3_size_6_2_2 gridGap_1">

                    <span></span>

                    <a href="{{url('/edit/product/'.$list->id)}}" class="pendingBtnR txtCenter">Edit product</a>
                    <a href="{{url('/delete/product/'.$list->id)}}" class="dangerBtnR txtCenter">Delete product</a>

                </div>


        </div>

        @endforeach







@endsection