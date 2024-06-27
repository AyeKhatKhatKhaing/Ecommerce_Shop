<option></option>
@foreach($region_list as $list)
    <option value="{{ $list->id }}">{{ $list->name_en }}</option>
@endforeach