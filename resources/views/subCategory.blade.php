@extends('frame')





@section('title')

    <!-- Title -->
    <title>CRUD - Sub Category</title>

@endsection





@section('container')




        <!-- Create new category -->

        <p class="p_0 mb_1 latoBold fSize_18px">Add Sub Category

            @error('sub_category')
				<span class="highlightAlert w_100Per txtCenter lato fSize_1">{{$message}}</span>
			@enderror

        </p>

        <table class="tableBasicBlue w_100Per">

            <tr>
                <th width="10%" class="fSize_1">S/N</th>
                <th width="35%" class="fSize_1">Sub Category</th>
                <th width="35%" class="fSize_1">Category</th>
                <th width="10%" class="fSize_1">Action</th>
                <th width="10%" class="fSize_1">Action</th>
            </tr>

            @if(session('actionType')=='insert')

            <form action="{{url('/add/sub/category')}}" method="post" class="w_100Per">
            @csrf

                <tr>
                    <td class="txtCenter fSize_1">0</td>
                    <td class="txtCenter">
                        <input  class="p_0_h fSize_1 w_95Per m_a border" type="text" name="sub_category" required>
                    </td>
                    <td>
                        <select class="p_0_h fSize_1 m_0 cusInp w_100Per" name="category_id" id="category_id" required>
                            @foreach($category as $list)
                                <option value="{{$list->id}}">{{$list->category}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="txtCenter">
                        <input class="successBtnR fSize_12px disGrid m_a w_100Per" value="Add" type="submit">
                    </td>
                    <td class="txtCenter">
                        <input class="dangerBtnR fSize_12px disGrid m_a w_100Per" value="Reset" type="reset">
                    </td>
                </tr>

            </form>

            @else

            <form action="{{url('/edit/sub/category/'.session('selectedSubCategoryID'))}}" method="post" class="w_100Per">
            @csrf

                <tr>
                    <td class="txtCenter fSize_1">0</td>
                    <td class="txtCenter">
                        <input  class="p_0_h fSize_1 w_95Per m_a border" type="text" name="sub_category" value="{{session('selectedSubCategory')}}" required>
                    </td>
                    <td>
                        <select class="p_0_h fSize_1 m_0 cusInp w_100Per" name="category_id" id="category_id" required>
                            @foreach($category as $list)
                                <option value="{{$list->id}}" selected>{{$list->category}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="txtCenter">
                        <input class="pendingBtnR fSize_12px disGrid m_a w_100Per" value="Edit" type="submit">
                    </td>
                    <td class="txtCenter">
                        <input class="dangerBtnR fSize_12px disGrid m_a w_100Per" value="Reset" type="reset">
                    </td>
                </tr>

            </form>
            @endif
        </table>


        <p class="p_0 mb_1 latoBold fSize_18px">Existing Category</p>


        <!-- Show, edit, delete category -->
        <table class="tableBasicBlue w_100Per">

            <tr class="disNone"></tr>

            <?php $serial = 1; ?>
            @foreach($data as $list)

            <tr>
                <td width="10%" class="txtCenter fSize_1"><?php echo $serial; $serial++; ?></td>
                <td width="35%" class="txtCenter">
                    {{$list->sub_category}}
                </td>
                <td width="35%" class="txtCenter">
                    {{$list->category}}
                </td>
                <td width="10%">
                    <a class="pendingBtnR fSize_12px disGrid justifyItemsCenter"  href="{{url('/edit/sub/category/'.$list->id)}}">Edit</a>
                </td>
                <td width="10%">
                    <a class="dangerBtnR fSize_12px disGrid justifyItemsCenter"  href="{{url('/delete/sub/category/'.$list->id)}}">Delete</a>
                </td>
            </tr>

            @endforeach

        </table>




@endsection