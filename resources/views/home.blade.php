@extends('frame')





@section('title')

    <!-- Title -->
    <title>CRUD - Items</title>

@endsection





@section('container')




        <!-- Create new category -->

        <h3 class="p_0 mb_1">Add Items</h3>


        <form action="{{url('/add/item')}}" method="post" class="itemUploader" enctype="multipart/form-data">
        @csrf

            <div>
                <img src="{{asset('media/system/imagePlaceHolder.jpg')}}" alt="Upload Photo" class="placeholder_image" onclick="triggerClick()">
                <input class="input img_uploader" type="file" name="sliderImage" onchange="displayImage(this)" id="place_holder">
            </div>

            <div class="itemInfo">

                <div>
                    <label for="sliderName">Slider Name</label>
                    <input  class="p_0_h fSize_1 m_0 cusInp" type="text" name="sliderName" required>
                </div>


                <div>
                
                    <label for="category">Slider Category</label>
                
                    <select class="p_0_h fSize_1 m_0 cusInp" name="category" id="category" required>
                        @foreach($category as $list2)
                        <option value="{{$list2->C_ID}}">{{$list2->Category}}</option>
                        @endforeach
                    </select>
                
                </div>


                <div>
                
                    <label for="status">Status</label>
                
                    <select class="p_0_h fSize_1 m_0 cusInp" name="status" id="status" required>
                        <option value="1">Available</option>
                        <option value="0">Unavailable</option>
                    </select>
                
                </div>

                @error('sliderImage')
					<span class="highlightDanger w_100Per txtCenter">{{$message}}</span>
				@enderror

                <input class="successBtnR fSize_1 lato disGrid m_a w_100Per" value="Insert" type="submit">

            </div>

        </form>


        <h3 class="p_0 mb_1">Existing Items</h3>


        <!-- Show, edit, delete items -->
        <table class="tableBasicBlue w_100Per">

            <tr>
                <th width="10%" class="fSize_1">S/N</th>
                <th width="10%" class="fSize_1">Image</th>
                <th width="25%" class="fSize_1">Slider Name</th>
                <th width="20%" class="fSize_1">Category</th>
                <th width="15%" class="fSize_1">Status</th>
                <th width="10%" class="fSize_1">Edit</th>
                <th width="10%" class="fSize_1">Delete</th>
            </tr>

            <?php $serial = 1; ?>
            @foreach($item as $list)
            <form action="{{url('/edit/item/'.$list->ID)}}" method="post" class="w_100Per" enctype="multipart/form-data">
            @csrf

                <tr>
                    <td width="10%" class="txtCenter fSize_1"><?php echo $serial; $serial++; ?></td>
                    <td width="10%" class="txtCenter">
                        @if($list->Slider_Image==null)
                        <div class="imgLayer">
                            <img src="{{asset('media/system/imagePlaceHolder.jpg')}}" alt="Upload Photo" class="placeholder_image">
                            <div class="file_1">
                                <label for="" class="fBtn">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </label>
                                <input class="fName" type="file" name="sliderImage">
                            </div>
                        </div>
                        @else
                        <div class="imgLayer">
                            <img src="{{asset('media/items/'.$list->Slider_Image)}}" alt="Upload Photo" class="placeholder_image">
                            <div class="file_1">
                                <label for="" class="fBtn">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </label>
                                <input class="fName" type="file" name="sliderImage">
                            </div>
                        </div>
                        @endif
                    </td>
                    <td width="25%" class="txtCenter">
                        <input class="p_0_h fSize_1 w_95Per m_a borNone" type="text" name="sliderName" value="{{$list->Slider_Name}}"  required>
                    </td>
                    <td width="20%">
                        <select class="p_0_h fSize_1 m_0 cusInp w_100Per" name="category" id="category" required>
                            @foreach($category as $list2)
                                @if($list->Category_ID==$list2->C_ID)
                                <option value="{{$list2->C_ID}}" selected>{{$list2->Category}}</option>
                                @else
                                <option value="{{$list2->C_ID}}">{{$list2->Category}}</option>
                                @endif
                            @endforeach
                        </select>
                    </td>
                    <td width="15%">
                        <select class="p_0_h fSize_1 m_0 cusInp w_100Per" name="status" id="status" required>
                            @if($list->Status==1)
                            <option value="1" selected>Available</option>
                            <option value="0">Unavailable</option>
                            @else
                            <option value="1">Available</option>
                            <option value="0" selected>Unavailable</option>
                            @endif
                        </select>
                    </td>
                    <td width="10%">
                        <input class="pendingBtnR fSize_12px disGrid m_a w_100Per" value="Edit" type="submit">
                    </td>
                    <td width="10%">
                        <a class="dangerBtnR fSize_12px disGrid justifyItemsCenter"  href="{{url('/delete/item/'.$list->ID)}}">Delete</a>
                    </td>
                </tr>

            </form>
            @endforeach

        </table>




@endsection