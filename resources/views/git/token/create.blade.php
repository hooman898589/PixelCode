<form action="{{route('repo.token.store')}}" method="post">
    @csrf
    <input name="token" type="text" >

    <br>
    <br>
    <input name="submit" type="submit">

</form>
