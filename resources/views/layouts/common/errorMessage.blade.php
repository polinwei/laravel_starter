@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>錯誤!!</strong>錯誤如下, 請排除<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
