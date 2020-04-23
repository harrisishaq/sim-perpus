@extends('layouts.app')
@section('page-heading', __('Buku'))

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset(('app-assets/css/core/menu/menu-types/vertical-menu.min.css')) }}">
<link rel="stylesheet" type="text/css" href="{{ asset(('app-assets/css/core/colors/palette-gradient.min.css')) }}">
<link rel="stylesheet" type="text/css" href="{{ asset(('app-assets/vendors/css/tables/datatable/datatables.min.css')) }}">
<style type="text/css">
.datepicker{z-index:1151;}
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
                                <a class="btn bg-primary font-weight-bold mr-1 mb-1" href="{{ url('mdata/buku/add') }}">
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
                                    <th colspan="3"></th>
                                    <th colspan="2" style="text-align:center">Stok</th>
                                    <th colspan="2"></th>
                                  </tr>
                                  <tr>
                                      <th style="text-align:center">Kode Buku</th>
                                      <th style="text-align:center">Judul Buku</th>
                                      <th style="text-align:center">Penerbit</th>
                                      <th style="text-align:center">Tersedia</th>
                                      <th style="text-align:center">Terpinjam</th>
                                      <th style="text-align:center">Status</th>
                                      <th style="text-align:center">Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @if (count($data))
                                      @foreach ($data as $d)
                                          <tr>
                                              <td style="text-align:center">{{ $d->kode_buku }}</td>
                                              <td style="text-align:center">{{ $d->nama_buku }}</td>
                                              <td style="text-align:center">{{ $d->penerbit['nama'] }}</td>
                                              <td style="text-align:center">{{ $d->stok_tersedia }}</td>
                                              <td style="text-align:center">{{ $d->stok_terpinjam }}</td>
                                              {!! Azk::getMDStatus ($d->status) !!}
                                              <td style="text-align:center">
                                                <a href="{{ url('mdata/buku/'.$d->id.'/edit') }}" class="btn btn-icon" title="@lang('Edit')" data-toggle="tooltip" data-placement="top">
                                                  <i class="fas fa-edit fa-sm"></i>
                                                </a>
                                                <a href="{{ url('mdata/buku/'.$d->id.'/destroy') }}" class="btn btn-icon"
                                                     title="@lang('Delete')"
                                                     data-toggle="tooltip"
                                                     data-placement="top"
                                                     data-method="DELETE"
                                                     data-confirm-title="@lang('Please Confirm')"
                                                     data-confirm-text="@lang('Are you sure that you want to delete this Type Of Loan?')"
                                                     data-confirm-delete="@lang('Yes, delete it!')">
                                                     <i class="fas fa-trash fa-sm"></i>
                                                  </a>
                                              </td>
                                          </tr>
                                      @endforeach
                                  @else
                                      <tr>
                                          <td colspan="7"><em>@lang('No records found.')</em></td>
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
<script src="{{ asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js')}}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js')}}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js')}}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('app-assets/js/scripts/datatables/datatable.js') }}"></script>
<script>
    $(document).ready(function() {
        $("#datatable").DataTable();
    });
</script>
@endsection
