@php
    use App\Models\User;
@endphp
<td>
    @foreach (User::find($row->id)->medicals as $item)
        {{$item->medical_centre_name}}
    @endforeach
</td>