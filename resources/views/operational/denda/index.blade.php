@extends('layouts.app')
@section('page-heading', __('List Denda Peminjaman'))

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
                    <div class="card-header">
                      <div class="card-tools">
                        <div class="float-right">
                            <div class="btn-group">
                                <a class="btn bg-info font-weight-bold mr-1 mb-1" href="{{ url('operational/denda/all') }}">
                                    @lang(__('Show All'))
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
                                      <th style="text-align:center">NIM</th>
                                      <th style="text-align:center">Judul Buku</th>
                                      <th style="text-align:center">Telat (Hari)</th>
                                      <th style="text-align:center">Denda</th>
                                      <th style="text-align:center">Status</th>
                                      <th style="text-align:center">Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @if (count($data))
                                      @foreach ($data as $d)
                                          <tr>
                                              <td style="text-align:center">{{ $d->transaksiInformation->mahasiswaInformation['nim'] }}</td>
                                              <td style="text-align:center">{{ $d->transaksiInformation->bukuInformation['nama_buku'] }}</td>
                                              <td style="text-align:center">{{ $d->hari_telat }}</td>
                                              <td style="text-align:center">{{ $d->denda }}</td>
                                              {!! Azk::getStatusDenda ($d->status) !!}
                                              @if ($d->status == 1)
                                                <td class="text-center">
                                                  <a class="btn-sm bg-danger font-weight-bold" href="{{ url('operational/denda/'.$d->id.'/bayar') }}">
                                                    @lang(__('Bayar'))
                                                  </a>
                                                </td>
                                              @else
                                                <td style="text-align:center;color:green;font-weight:bold;">
                                                  Lunas
                                                </td>
                                              @endif
                                                <!-- <a href="{{ url('operational/transaksi/'.$d->id.'/edit') }}" class="btn btn-icon" title="@lang('Edit')" data-toggle="tooltip" data-placement="top">
                                                  <large><i class="fas fa-edit"></i></large>
                                                </a>
                                                <a href="{{ url('operational/transaksi/'.$d->id.'/destroy') }}" class="btn btn-icon" title="@lang('Delete')" data-toggle="tooltip" data-placement="top" data-method="DELETE" data-confirm-title="@lang('Please Confirm')" data-confirm-text="@lang('Are you sure that you want to delete this Type Of Loan?')" data-confirm-delete="@lang('Yes, delete it!')">
                                                  <large><i class="fas fa-trash"></i></large>
                                                </a> -->
                                          </tr>
                                      @endforeach
                                  @else
                                      <tr>
                                          <td colspan="6"><em>@lang('No records found.')</em></td>
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
<script src="{{ asset('app-assets/js/scripts/modal/components-modal.min.js')}}"></script>
<script src="{{ asset('app-assets/js/scripts/datatables/datatable.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
          "responsive": true,
          "autoWidth": false,
          "order": [], 
        });
    });
</script>
@endsection
