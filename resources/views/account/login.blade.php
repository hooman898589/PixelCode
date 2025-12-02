
<form method="post" action="{{route('login')}}">
    @csrf

ایمیل:<input type="text" name="email">
<br>
<br>
پسورد: <input type="text" name="password" >
<br>
<br>
    <input type="submit">
</form>
