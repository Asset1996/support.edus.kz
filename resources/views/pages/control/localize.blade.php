@extends('layouts.controlPanel')
@section('content')
<body>
<h3>{{ Lang::get('Website localization') }}</h3>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ Lang::get('Original') }}</th>
            <th scope="col">{{ Lang::get('Translate') }}</th>
            <th scope="col"></th>
        </tr>
    </thead>
    @foreach ($translates as $key=>$val)
        <tbody>
            <tr>
                <form method="POST" action="{{ route('localize-post') }}">
                    @csrf
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>
                        @if (Str::length($val) > 40)
                            <textarea name="original" class="form-control" rows="4" readonly="readonly">{{ $key }}</textarea>
                        @else
                            <input value="{{ $key }}" name="original" type="text" class="form-control" readonly="readonly">
                        @endif
                    </td>
                    <td>
                        @if (Str::length($val) > 40)
                            <textarea name="translate" class="form-control" rows="4">{{ $val }}</textarea>
                        @else
                            <input value="{{ $val }}" name="translate" type="text" class="form-control">
                        @endif
                    </td>
                    <td><button type="submit" class="btn btn-primary">{{ Lang::get('Save') }}</button></td>
                </form>
            </tr>
        </tbody>
    @endforeach
</table>
<nav aria-label="Page navigation example">
    <ul class="pagination">
        @if ($paginator['page'] != 1)
            <li class="page-item"><a class="page-link" href="{{ URL::toRoute($cur = Route::current(), ['page' => $paginator['page'] - 1] + $cur->parameters(), true) }}">Previous</a></li>
        @endif
        @for ($i = 1; $i <= $paginator['total_pages_count']; $i++)
            <li class="page-item"><a class="page-link" href="{{ URL::toRoute($cur = Route::current(), ['page' => $i] + $cur->parameters(), true) }}">{{ $i }}</a></li>
        @endfor
        @if ($paginator['page'] != $paginator['total_pages_count'])
            <li class="page-item"><a class="page-link" href="{{ URL::toRoute($cur = Route::current(), ['page' => $paginator['page'] + 1] + $cur->parameters(), true) }}">Next</a></li>
        @endif
    </ul>
</nav>
</body>
@stop