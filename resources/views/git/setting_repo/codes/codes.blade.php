


@foreach($codes['files'] as $code)
    <br>
    <br>
    <br>
address : {{$code['filename']}}
    <br>
    <br>
    <br>

        @if (!empty($code['patch']))

            <a href="/Repo/code/{{$username}}/{{$repo}}/{{$branch}}?filename={{$code['filename']}}" >content</a>

{{--           <?php $file=explode("\n",$code['patch']);--}}

{{--            ?>--}}

{{--    <textarea rows="40" cols="180"  name="code">--}}

{{--        @foreach($file as $key => $value)--}}
{{--                <?php $file_x=explode('+',$value,2);?>--}}
{{--                @if(!empty($file_x[1]))--}}
{{--                {{$file_x[1]}}--}}

{{--                @elseif(empty($file_x[1]))--}}
{{--                {{$value}}--}}
{{--                @endif--}}
{{--        @endforeach--}}
{{--    </textarea>--}}
        @endif
@endforeach
