
{{--reqester--}}
<form method="post" action="{{route('register')}}">
    @csrf
    نام:<input type="text" name="name">
    <br>
    <br>
    ایمیل: <input type="text" name="email">
    <br>
    <br>
    پسورد: <input type="text" name="password" >

    <br>
    <br>
    تکرار پسورد:<input type="text" name="confirm_password">
    <br>
    <br>
    <input type="submit">
</form>
