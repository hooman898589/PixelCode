



@foreach($commits as $commit)

    @if (empty($commit['author']))
        <?php $author='branch owner'; ?>
    @else
        <?php
            $author=$commit['author']['login'];?>
    @endif

<br>
<br>
    <a href="/Repo/codes/{{$commit['sha']}}/{{$username}}/{{$repo}}" >{{$commit['commit']['message']}}</a>

    <br>
    <br>
    author : {{$author}}
<br>
    <br>
    name : {{$commit['commit']['author']['name']}}

<br>

    <br>
    _____________________________________________________________________________________
@endforeach
