


@foreach($addprojects as $addproject)

    کاربر : {{$addproject->useritems->name}}

    <br>
    <br>
    توسط : {{$addproject->owneritems->name}}
    <br>
    <br>

    @if($addproject->owneritems->id==Auth::id() and $addproject->useritems->id!=Auth::id())
        <form method="post" action="/Repo/add-in-project/{{$addproject->id}}" >
            @csrf
            @method('delete')
            <button type="submit">حذف</button>
        </form>
    @endif
@endforeach
