


<form method="post" action="{{route('changepassword')}}" >
    @csrf
    @method('patch')
    <input type="hidden" name="token" value="{{$token}}">
    پسورد جدید<input type="text" name="password">
    <br>
    <br>
   تکرار اش: <input type="text" name="com_password">
    <br>
    <br>
    <input type="submit">
</form>
