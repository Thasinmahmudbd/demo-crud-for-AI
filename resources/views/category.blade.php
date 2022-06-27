@extends('frame')





@section('title')

    <!-- Title -->
    <title>CRUD - Category</title>

@endsection





@section('container')




        <!-- Create new category -->

        <h3 class="p_0 mb_1">Add Category</h3>

        <table class="tableBasicBlue w_100Per">

            <tr>
                <th width="10%" class="fSize_1">S/N</th>
                <th width="70%" class="fSize_1">Category</th>
                <th width="10%" class="fSize_1">Action</th>
                <th width="10%" class="fSize_1">Action</th>
            </tr>

            <form action="{{url('/add/category')}}" method="post" class="w_100Per">
            @csrf

                <tr>
                    <td class="txtCenter fSize_1">0</td>
                    <td class="txtCenter">
                        <input  class="p_0_h fSize_1 w_95Per m_a border" type="text" name="category" required>
                    </td>
                    <td class="txtCenter">
                        <input class="successBtnR fSize_12px disGrid m_a w_100Per" value="Add" type="submit">
                    </td>
                    <td class="txtCenter">
                        <input class="dangerBtnR fSize_12px disGrid m_a w_100Per" value="Reset" type="reset">
                    </td>
                </tr>

            </form>
        </table>


        <h3 class="p_0 mb_1">Existing Category</h3>


        <!-- Show, edit, delete category -->
        <table class="tableBasicBlue w_100Per">

            <tr class="disNone"></tr>

            <?php $serial = 1; ?>
            @foreach($data as $list)
            <form action="{{url('/edit/category/'.$list->C_ID)}}" method="post" class="w_100Per">
            @csrf

                <tr>
                    <td width="10%" class="txtCenter fSize_1"><?php echo $serial; $serial++; ?></td>
                    <td width="70%" class="txtCenter">
                        <input  class="p_0_h fSize_1 w_95Per m_a borNone" type="text" name="category" value="{{$list->Category}}"  required>
                    </td>
                    <td width="10%">
                        <input class="pendingBtnR fSize_12px disGrid m_a w_100Per" value="Edit" type="submit">
                    </td>
                    <td width="10%">
                        <a class="dangerBtnR fSize_12px disGrid justifyItemsCenter"  href="{{url('/delete/category/'.$list->C_ID)}}">Delete</a>
                    </td>
                </tr>

            </form>
            @endforeach

        </table>




@endsection