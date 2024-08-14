@extends('admin.dashboard')

@section('title')
    Chi tiet danh muc {{ $model->name}}
@endsection

@section('content')
    <table class="table">
        <tr>
            <th>Truong</th>
            <th>Value</th>
        </tr>

        @foreach ($model->toArray() as $field => $value)
            <tr>
                <td>{{ $field }}</td>
                <td>
                    @php
                        if ($field == 'cover') {
                            $url = \Storage::url($value);

                            echo "<img src=\"$url\" width=\"50px\" alt=\"\">";
                        } elseif (\Str::contains($field, 'is_')) {
                            echo $value
                                ? '<span class="badge bg-primary">YES</span>' 
                                : '<span class="badge bg-danger">NO</span>';
                        } else {
                            echo $value;
                        }
                    @endphp
                </td>
            </tr>
        @endforeach
    </table>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-danger">Q/L trang chu</a>
@endsection
