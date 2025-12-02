

@foreach($branches as $branch)

    @if(empty($branch['sha']))
    <?php
$sha=$branch['commit']['sha'];
?>
    @else
        <?php
$sha=$branch['sha'];
            ?>

@endif
    <span style="color: red" >{{$branch['name']}}</span>
    <br>
    <br>
    <a href="/Repo/commits/{{$username}}/{{$repo}}/{{$sha}}"  >مشاهد کامیت ها</a>
    <br>
    <br>
    ________________________________________________________________________
    <br>
    <br>
@endforeach
