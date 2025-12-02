


@if(!empty($token) )
token : {{$token->token}}


<br>
<br>
user :{{$token->useritem->name}}


<form action="/Repo/token/{{$token->id}}" method="post">
    @csrf
    @method('delete')
<input type="submit" value="حذف">
</form>
@else
    در حال حاضر توکن ایی ندارید



@endif
