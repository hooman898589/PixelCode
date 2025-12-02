<form action="{{route('repo.store')}}" method="post">
    @csrf
    ریپازیتوری:<input type="text" name="repo" id="">
    <br>
    <br>
    نام کاربری مالک :<input type="text" name="username">
    <br>
    <br>
    <input type="submit" value="ثبت">
</form>
