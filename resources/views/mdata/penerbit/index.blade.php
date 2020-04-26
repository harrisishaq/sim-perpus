@extends('layouts.app')
@section('page-heading', __('Penerbit'))

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset(('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')) }}">
<link rel="stylesheet" type="text/css" href="{{ asset(('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')) }}">
@endsection


@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                @include('partials.messages')
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-header">
                      <div class="card-tools">
                        <div class="float-right">
                            <div class="btn-group">
                                <a class="btn bg-primary font-weight-bold mr-1 mb-1" href="{{ url('mdata/penerbit/add') }}">
                                    <i class="fas fa-plus mr-2"></i>
                                    @lang(__(' Add Data'))
                                </a>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" id="users-table-wrapper">
                          <table class="table table-striped table-borderless" id="datatable">
                              <thead>
                                  <tr>
                                      <th style="text-align:center">Kode Penerbit</th>
                                      <th style="text-align:center">Nama Penerbit</th>
                                      <th style="text-align:center">Status</th>
                                      <th style="text-align:center">Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @if (count($data))
                                      @foreach ($data as $d)
                                          <tr>
                                              <td style="text-align:center">{{ $d->id }}</td>
                                              <td style="text-align:center">{{ $d->nama }}</td>
                                              {!! Azk::getStatusPenerbit ($d->status) !!}
                                              <td class="text-center">
                                                <a class="btn-sm bg-primary font-weight-bold mr-1 mb-1" href="{{ url('mdata/penerbit/'.$d->id.'/edit') }}">
                                                  <i class="fas fa-edit"></i>
                                                </a>
                                                <a class="btn-sm bg-danger font-weight-bold ml-1 mb-1" href="{{ url('mdata/penerbit/'.$d->id.'/destroy') }}">
                                                  <i class="fas fa-trash"></i>
                                                </a>
                                                <!-- <a href="{{ url('mdata/penerbit/'.$d->id.'/edit') }}" class="btn btn-icon" title="@lang('Edit')" data-toggle="tooltip" data-placement="top">
                                                  <large><i class="fas fa-edit"></i></large>
                                                </a>
                                                <a href="{{ url('mdata/penerbit/'.$d->id.'/destroy') }}" class="btn btn-icon"
                                                     title="@lang('Delete')"
                                                     data-toggle="tooltip"
                                                     data-placement="top"
                                                     data-method="DELETE"
                                                     data-confirm-title="@lang('Please Confirm')"
                                                     data-confirm-text="@lang('Are you sure that you want to delete this Type Of Loan?')"
                                                     data-confirm-delete="@lang('Yes, delete it!')">
                                                     <large><i class="fas fa-trash"></i></large>
                                                  </a> -->
                                              </td>
                                          </tr>
                                      @endforeach
                                  @else
                                      <tr>
                                          <td colspan="4"><em>@lang('No records found.')</em></td>
                                      </tr>
                                  @endif
                              </tbody>
                          </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('scripts')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script>
    $('#datatable').DataTable({
      "responsive": true,
      "autoWidth": false, 
    });
</script>
@endsection
