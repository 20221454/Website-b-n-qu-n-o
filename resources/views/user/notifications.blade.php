
@include('layouts.User.header')

@section('content')

<h2>Thông báo</h2>

@foreach($notifications as $noti)
    <div style="border:1px solid #ccc; margin:10px; padding:10px">
        <h4>{{ $noti->title }}</h4>
        <p>{{ $noti->content }}</p>

        @if(!$noti->is_read)
            <form method="POST" action="/thong-bao/{{ $noti->id }}/read">
                @csrf
                <button>Đánh dấu đã đọc</button>
            </form>
        @endif
    </div>
@endforeach

@include('layouts.footer')