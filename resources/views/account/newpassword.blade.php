<form action="{{route('newpassword')}}" method="post">
    @csrf
    ایمیل:<input type="text" name="email">
    <br>
    <br>
    <input type="submit" value="برو">
</form>
