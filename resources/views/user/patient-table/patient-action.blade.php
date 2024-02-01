@if(Auth::user()->role == 4)
<a href="{{ url("editpatient/$row->id") }}" style="margin-bottom:10px;" class="btn btn-success">Edit & Review</a>
<form action="{{ url("/patients/$row->id") }}" method="POST"
    onsubmit="return confirm('Do you really want to delete the task?');">
    @csrf
    @method("delete")
    <input type="submit" name="" value="Delete" class="btn btn-danger btn-sm">
</form>
@endif