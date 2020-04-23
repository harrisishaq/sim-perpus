@extends('layouts.app')
@section('page-heading', __('List Transaksi Peminjaman Buku'))

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
                    <div class="card-body">
                        <div class="table-responsive" id="users-table-wrapper">
                          <table class="table table-striped table-borderless" id="datatable">
                              <thead>
                                  <tr>
                                      <th style="text-align:center">NIM</th>
                                      <th style="text-align:center">Judul Buku</th>
                                      <th style="text-align:center">Tanggal Pinjam</th>
                                      <th style="text-align:center">Batas Pinjam</th>
                                      <th style="text-align:center">Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @if (count($data))
                                      @foreach ($data as $d)
                                          <tr>
                                              <td style="text-align:center">{{ $d->mahasiswaInformation['nim'] }}</td>
                                              <td style="text-align:center">{{ $d->bukuInformation['nama_buku'] }}</td>
                                              <td style="text-align:center">{{ $d->date_from }}</td>
                                              <td style="text-align:center">{{ $d->date_until }}</td>
                                              <td style="text-align:center">
                                                <a class="btn-sm bg-info font-weight-bold" href="{{ url('operational/transaksi/'.$d->id.'/kembali') }}">
                                                  @lang(__('Kembali'))
                                                </a>
                                              </td>
                                              <!-- <td class="text-center">
                                                <a href="{{ url('operational/transaksi/'.$d->id.'/edit') }}" class="btn btn-icon" title="@lang('Edit')" data-toggle="tooltip" data-placement="top">
                                                  <large><i class="fas fa-edit"></i></large>
                                                </a>
                                                <a href="{{ url('operational/transaksi/'.$d->id.'/destroy') }}" class="btn btn-icon" title="@lang('Delete')" data-toggle="tooltip" data-placement="top" data-method="DELETE" data-confirm-title="@lang('Please Confirm')" data-confirm-text="@lang('Are you sure that you want to delete this Type Of Loan?')" data-confirm-delete="@lang('Yes, delete it!')">
                                                  <large><i class="fas fa-trash"></i></large>
                                                </a>
                                              </td> -->
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
