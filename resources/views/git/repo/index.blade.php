

@foreach($repos as $repo)

    <span style="color: red" >repository : {{$repo->repo}} </span><span style="color:blue" > the owener : {{$repo->username}}</span>
    <br>
    <br>
    <a href="/Repo/branches/{{$repo->username}}/{{$repo->repo}}" > open repository</a>
    <br>
    <br>
    <a href="{{route('repo.edit',$repo->slug)}}" >edit repo </a>
    <br>
    <br>
    <form action="{{route('repo.delete',$repo->slug)}}" method="post">
        @csrf
        @method('delete')
        <input type="submit" value="حذف">
    </form>

    <br>
    <br>

@endforeach
