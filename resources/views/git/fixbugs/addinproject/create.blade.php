

<form method="post" action="{{route('repo.add-in-project.store',$repo)}}" >
@csrf
ایمیل :<input type="text" name="email">
<br>
    <br>
    <input type="submit">
</form>
