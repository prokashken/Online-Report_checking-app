@if ($row->role == 1)
    Only Import
@elseif($row->role == 2)
    Only Export
@elseif($row->role == 3)
    Both Emport & Export
@else
    Not Set
@endif