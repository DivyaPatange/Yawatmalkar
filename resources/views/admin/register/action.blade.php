<a href="{{ route('admin.register.show', $id) }}"><button type="button" class="btn btn-outline-primary btn-sm" title="" ><i class="fa fa-eye"></i></button></a>
<a href="{{ route('admin.register.edit', $id) }}"><button type="button" class="btn btn-outline-warning btn-sm" title="" ><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
<a href="{{ route('admin.register.edit-document', $id) }}"><button type="button" class="btn btn-outline-warning btn-sm" title="" ><i class="fa fa-file"></i></button></a>
<a href="javascript:void(0)" id="delete" data-id="{{ $id }}"><button type="button" class="btn btn-outline-danger btn-sm" title="" ><i class="fa fa-trash" aria-hidden="true"></i></button></a>