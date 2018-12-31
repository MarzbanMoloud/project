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
           <form action="{{ route('saveQuestion') }}" method="POST">

               <input type="hidden" name="question_id" value="{{ isset($question) ? $question['id'] : null }}">
               @csrf

               <div class="form-group col-md-4">
                   <label for="title">عنوان</label>
                   <input type="text" class="form-control" id="title" name="title" value="{{ isset($question) ? $question['title'] : old('title') }}">
               </div>

               <div class="form-group col-md-4">
                   <label for="description">سوال</label>
                   <textarea class="form-control" name="description" id="description"  cols="30" rows="3">
                       {{ isset($question) ? $question['description'] : old('description') }}
                   </textarea>
               </div>

               @role('user')
                   <div class="form-group">
                       <input class="btn btn-primary" type="submit" value="ارسال">
                   </div>
               @endrole
           </form>
       </div>

    <div>
        <table class="table" >
            <tr>
                <th style="text-align: right">شناسه</th>
                <th style="text-align: right">عنوان سوال</th>
                <th style="text-align: right">متن سوال</th>
                <th style="text-align: right">کاربر</th>
                <th style="text-align: right">پاسخ</th>
                <th style="text-align: right">عملیات</th>
            </tr>
            @forelse($questions as $key => $value)
                <tr>
                    <td> {{$value->id}} </td>
                    <td> {{ $value->title }} </td>
                    <td> {{ $value->description }} </td>
                    <td> {{ $value->user['name'] }} </td>

                    @if(isset($value->answers[0]) and $value->answers != [])
                        <td> {{ $value->answers[0]->description }} </td>
                    @else
                        <td> {{ '-' }} </td>
                    @endif

                    <td>
                        <a href="edit/{{ $value->id }}">
                            <button class="btn btn-info btn-sm">ویرایش</button>
                        </a>
                    </td>
                </tr>
            @empty
                 <tr>
                     <td>{{ 'موردی یافت نشد' }}</td>
                 </tr>
            @endforelse
        </table>
    </div>
    </body>
</html>
