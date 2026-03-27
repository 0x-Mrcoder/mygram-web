@extends('admin.partials.master')
@section('admin_content')
    <section id="dashboard-ecommerce">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title">
                            <div class="d-flex justify-content-between">
                                <div>Package Lists</div>
                                <div>
                                    <a href="{{route('admin.setting.index')}}" class="btn btn-info btn-sm mr-1"> <i class="bx bx-cog"></i> Payment Settings </a>
                                    <a href="{{route('admin.package.create')}}" class="btn btn-primary btn-sm"> <i class="bx bx-plus"></i> Add New Item </a>
                                </div>
                            </div>
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table table-striped dataex-html5-selectors">
                                    <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Name</th>
                                        <th>Label</th>
                                        <th>Tab</th>
                                        <th>Photo</th>
                                        <th>Price</th>
                                        <th>Validity</th>
                                        <th>Event</th>
                                        <th>Status</th>
                                        <th>Active</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($packages as $key => $row)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$row->name}}</td>
                                            <td>{{$row->label}}</td>
                                            <td>{{$row->tab}}</td>
                                            <td>
                                                <img width="40" src="{{asset(view_image($row->photo))}}" alt="Package Photo">
                                            </td>
                                            <td>{{$row->price}}</td>
                                            <td>{{$row->validity}}Days</td>
                                            <td>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input event-status" id="event_status_{{$row->id}}" data-id="{{$row->id}}" {{$row->is_event_active ? 'checked' : ''}}>
                                                    <label class="custom-control-label" for="event_status_{{$row->id}}"></label>
                                                </div>
                                            </td>
                                            <td>{{$row->status}}</td>
                                            <td>
                                                <a href="{{route('admin.package.create', $row->id)}}"
                                                   class="btn btn-warning" style="padding: 3px 7px;font-size: 20px" data-toggle="tooltip" title='Edit'>
                                                    <i class="bx bx-pencil"></i></a>
                                                <form method="POST" action="{{route('admin.package.delete', $row->id)}}"
                                                      class="d-inline">@csrf
                                                    {{method_field('DELETE')}}
                                                    <button type="submit"
                                                            style="padding: 3px 7px;"
                                                            class="btn btn-icon btn-danger delete_confirm{{$row->id}}"
                                                            data-toggle="tooltip" title='Delete'>
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                    @include('admin.partials.delete-confirmation')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function(){
            $(document).on('change', '.event-status', function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('admin.package.event_status') }}",
                    data: {'status': status, 'id': id, '_token': "{{ csrf_token() }}"},
                    success: function(data){
                        if(data.status){
                           toastr.success(data.msg);
                        }else{
                           toastr.error(data.msg);
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error("An error occurred: " + error);
                    }
                });
            });
        });
    </script>
@endsection


