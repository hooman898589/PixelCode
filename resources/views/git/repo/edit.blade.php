

<form action="{{route('repo.update',$repo->slug)}}" method="post">
    @csrf
    @method('put')
    ریپازیتوری:<input type="text" name="repo" value="{{$repo->repo}}">
    <br>
    <br>
    نام کاربری مالک :<input type="text" name="username" value="{{$repo->username}}">
    <br>
    <br>
    <input type="submit" value="ثبت">
</form>
