<a href="{{ route('admin.doctors.show', $id) }}"><button type="button" class="btn btn-outline-primary btn-sm" title="" >View</button></a>
<a href="{{ route('admin.doctors.edit', $id) }}"><button type="button" class="btn btn-outline-warning btn-sm" title="" >Edit</button></a>
<a href="javascript:void(0)" id="delete" data-id="{{ $id }}"><button type="button" class="btn btn-outline-danger btn-sm" title="" >Delete</button></a>