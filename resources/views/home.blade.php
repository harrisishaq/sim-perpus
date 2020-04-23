@extends('layouts.app')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset(('app-assets/css/core/menu/menu-types/vertical-menu.min.css')) }}">
<link rel="stylesheet" type="text/css" href="{{ asset(('app-assets/css/core/colors/palette-gradient.min.css')) }}">
<link rel="stylesheet" type="text/css" href="{{ asset(('app-assets/vendors/css/tables/datatable/datatables.min.css')) }}">
<style type="text/css">
.datepicker{z-index:1151;}
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive" id="users-table-wrapper">
                          <table class="table table-striped table-borderless" id="datatable">
                              <thead>
                                  <tr>
                                      <th style="text-align:center">Kode Buku</th>
                                      <th style="text-align:center">Judul Buku</th>
                                      <th style="text-align:center">Penerbit</th>
                                      <th style="text-align:center">Stok Tersedia</th>
                                      <th style="text-align:center">Stok Terpinjam</th>
                                      <th style="text-align:center">Status</th>
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
</div>
@endsection

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