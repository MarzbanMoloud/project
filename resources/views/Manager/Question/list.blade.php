<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</head>
<body style="direction: rtl">
<div>
    <table class="table" >
        <tr>
            <th style="text-align: right">شناسه</th>
            <th style="text-align: right">عنوان سوال</th>
            <th style="text-align: right">متن سوال</th>
            <th style="text-align: right">کاربر</th>
            <th style="text-align: right">پاسخ</th>
            <th style="text-align: right">عکس</th>
            <th style="text-align: right">عملیات</th>
        </tr>
        @forelse($questions as $key => $value)
            <tr>
                <td> {{ $value->id }} </td>
                <td> {{ $value->title }} </td>
                <td> {{ $value->description }} </td>
                <td> {{ $value->user['name'] }} </td>
                @if(isset($value->answers[0]) and $value->answers != [])
                    <td>
                        <a href="answers/{{ $value->id }}"><button class="btn btn-success btn-sm">مشاهده پاسخ ها</button></a>
                    </td>
                @else
                    <td> {{ '-' }} </td>
                @endif

                @if(isset($value->image) and $value->image != '')
                    <td>
                        <img src="{{ asset($value->image['path']) }}" alt="" style="width: 30px; height: 30px">
                    </td>
                @else
                    <td> {{ '-' }} </td>
                @endif
                
                <td>
                    <button class="btn btn-info btn-sm reply" data-id="{{ $value->id }}">پاسخ</button>
                    <a href="removeQuestion/{{ $value->id }}"><button class="btn btn-danger btn-sm">حذف</button></a>
                </td>
            </tr>
        @empty
            <tr>
                <td>{{ 'موردی یافت نشد' }}</td>
            </tr>
        @endforelse
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="answerModal" role="dialog">
    <form action="{{ route('saveAnswer') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="question_id" name="question_id" value="">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">پاسخ</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">عنوان پاسخ</label>
                        <input type="text" class="form-control" name="title">
                    </div>

                    <div class="form-group">
                        <label for="title">متن پاسخ</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <input type="file" name="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="ارسال">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">انصراف</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $('.reply').on('click' , function () {
        var id = $(this).attr('data-id');
        $('#question_id').val(id);
        console.log(id);
        $('#answerModal').modal('show');
    })
</script>
</body>
</html>
