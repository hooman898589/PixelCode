



@foreach($commits as $commit)

    @if (empty($commit['author']))
        <?php $author='branch owner'; ?>
    @else
        <?php
            $author=$commit['author']['login'];?>
    @endif

<br>
<br>
    <a href="/Repo/files/{{$commit['sha']}}/{{$username}}/{{$repo}}/{{$branch}}" >{{$commit['commit']['message']}}</a>

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
<br>
<br>
<a href="?page={{$page+=1}}">بیشتر</a>

<br>
<br>
<a href="?page={{$page-=2}}">قبلی</a>
