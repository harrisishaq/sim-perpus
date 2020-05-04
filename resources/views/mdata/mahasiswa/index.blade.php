@extends('layouts.app')
@section('page-heading', __('Mahasiswa'))

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset(('app-assets/css/core/menu/menu-types/vertical-menu.min.css')) }}">
<link rel="stylesheet" type="text/css" href="{{ asset(('app-assets/css/core/colors/palette-gradient.min.css')) }}">
<link rel="stylesheet" type="text/css" href="{{ asset(('app-assets/vendors/css/tables/datatable/datatables.min.css')) }}">
<style type="text/css">
.datepicker{z-index:1151;}
</style>
<style type="text/css">
  table.fixed td {overflow:hidden;}/*Hide text outside the cell.*/
  table.fixed td:nth-of-type(5) {width:80px;}/*Setting the width of column 1.*/
</style>
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
                                <a class="btn bg-primary font-weight-bold mr-3 mb-1" href="{{ url('mdata/mahasiswa/add') }}">
                                    <i class="fas fa-plus mr-2"></i>
                                    @lang(__(' Add Data'))
                                </a>
                                <a class="btn bg-success font-weight-bold mr-1 mb-1" data-toggle="modal" data-target="#modalImport">
                                    <i class="fas fa-plus mr-2"></i>
                                    @lang(__(' Add Data by Excel'))
                                </a>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" id="users-table-wrapper">
                          <table class="table table-striped table-borderless fixed" id="datatable">
                              <thead>
                                  <tr>
                                      <th style="text-align:center">NIM</th>
                                      <th style="text-align:center">Nama</th>
                                      <th style="text-align:center">Email</th>
                                      <th style="text-align:center">No. HP</th>
                                      <th style="text-align:center">Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @if (count($data))
                                      @foreach ($data as $d)
                                          <tr>
                                              <td style="text-align:center">{{ $d->nim }}</td>
                                              <td style="text-align:center">{{ $d->nama }}</td>
                                              <td style="text-align:center">{{ $d->email }}</td>
                                              <td style="text-align:center">{{ $d->no_hp }}</td>
                                              <td class="text-center">
                                                <a class="btn-sm bg-primary font-weight-bold mr-1 mb-1" href="{{ url('mdata/mahasiswa/'.$d->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Edit">
                                                  <i class="fas fa-edit"></i>
                                                </a>
                                                <a class="btn-sm bg-danger font-weight-bold ml-1 mb-1" href="{{ url('mdata/mahasiswa/'.$d->id.'/destroy') }}" data-toggle="tooltip" data-placement="top" title="Delete">
                                                  <i class="fas fa-trash"></i>
                                                </a>
                                                <!-- <a href="{{ url('mdata/mahasiswa/'.$d->id.'/edit') }}" class="btn btn-icon" title="@lang('Edit')" data-toggle="tooltip" data-placement="top">
                                                  <large><i class="fas fa-edit"></i></large>
                                                </a>
                                                <a href="{{ url('mdata/mahasiswa/'.$d->id.'/destroy') }}" class="btn btn-icon"
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
                                          <td colspan="5"><em>@lang('No records found.')</em></td>
                                      </tr>
                                  @endif
                              </tbody>
                          </table>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modalImport" tabindex="-1" role="dialog" aria-labelledby="modalImportTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                  role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <h5 class="modal-title" id="modalImportTitle">Import Data Mahasiswa by Excel</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                          </div>
                          <div class="modal-body">
                            <form action="{{ url('mdata/mahasiswa/import-excel') }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <div class="form-group">
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="file" name="file">
                                  <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                              </div>
                              <button class="btn btn-success">Import Data</button>
                            </form>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>
    </section>
@stop

@section('scripts')
<script src="{{ asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js')}}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js')}}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js')}}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('app-assets/js/scripts/modal/components-modal.min.js')}}"></script>
<script src="{{ asset('app-assets/js/scripts/datatables/datatable.js') }}"></script>
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $("#datatable").DataTable();
    });
    $(document).ready(function () {
      bsCustomFileInput.init();
    });
</script>
@endsection
