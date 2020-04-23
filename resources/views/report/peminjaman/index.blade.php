@extends('layouts.app')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset(('app-assets/css/core/menu/menu-types/vertical-menu.min.css')) }}">
<link rel="stylesheet" type="text/css" href="{{ asset(('app-assets/css/core/colors/palette-gradient.min.css')) }}">
<link rel="stylesheet" type="text/css" href="{{ asset(('app-assets/vendors/css/tables/datatable/datatables.min.css')) }}">
<style type="text/css">
.datepicker{z-index:1151;}
</style>
@endsection
@section('page-title', __('Laporan Peminjaman'))
@section('page-heading', __('Laporan Peminjaman'))

@section('content')

    @include('partials.messages')
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <div class="float-right">
                    <div class="btn-group">
                            <a class="btn bg-danger mr-2 mb-2" data-toggle="modal" data-target="#modalReport">
                            <i class="fas fa-print mr-1"></i>
                            @lang('Download PDF')
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
                            <th colspan="2"></th>
                            <th colspan="2" style="text-align:center;">Tanggal</th>
                            <th colspan="1"></th>
                        </tr>
                        <tr>
                            <th style="text-align:center">No. Transaksi</th>
                            <th style="text-align:center">NIM</th>
                            <th style="text-align:center">Judul Buku</th>
                            <th style="text-align:center">Pinjam</th>
                            <th style="text-align:center">Batas Kembali</th>
                            <th style="text-align:center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($data))
                            @foreach ($data as $d)
                                <tr>
                                    <td style="text-align:center">{{ $d->id }}</td>
                                    <td style="text-align:center">{{ $d->mahasiswaInformation['nim'] }}</td>
                                    <td style="text-align:center">{{ $d->bukuInformation['nama_buku'] }}</td>
                                    <td style="text-align:center">{{ $d->date_from }}</td>
                                    <td style="text-align:center">{{ $d->date_until }}</td>
                                    {!! Azk::getStatusTransaksi ($d->status) !!}
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
    <div class="modal fade" id="modalReport" tabindex="-1" role="dialog"
        aria-labelledby="modalReportTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
        role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modalReportTitle">Ekspor Laporan Peminjaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                {{ Form::open(array('url' => 'laporan/peminjaman/report-pdf', 'method' => 'post', 'id' => 'formExport' )) }}
                    <div class="form-group">
                        <ul class="list-unstyled mb-0">
                            <li>
                                <fieldset>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="radio" id="customRadio1" value="all" checked>
                                    <label class="custom-control-label" for="customRadio1">Export All Data</label>
                                </div>
                                </fieldset>
                            </li>
                            <li>
                                <fieldset>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="radio" id="customRadio2" value="nim">
                                    <label class="custom-control-label" for="customRadio2">Export Nomor Induk Mahasiswa (NIM)</label>
                                </div>
                                </fieldset>
                            </li>
                            <li>
                                <fieldset>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="radio" id="customRadio3" value="month">
                                    <label class="custom-control-label" for="customRadio3">Export by Month</label>
                                </div>
                                </fieldset>
                            </li>
                            <li>
                                <fieldset>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="radio" id="customRadio4" value="specific">
                                    <label class="custom-control-label" for="customRadio4">Export Specific</label>
                                </div>
                                </fieldset>
                            </li>
                        </ul>
                        <br>
                        <div id="mahasiswa" style="display: none;">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nim">Nomor Induk Mahasiswa (NIM)</label>
                                    <input type="hidden" name="mahasiswas_id" id="id">
                                    <div class="input-group">
                                        <input type="text" value="" name="nim" class="form-control" placeholder="Nomor Induk Mahasiswa (NIM)" id="nim" aria-describedby="ic" autocomplete="off">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="ic">
                                                <i class="fa fa-user"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <small class="text-danger font-italic" id="txt_valid" style="display: none;">NIM not valid.</small>
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama Mahasiswa</label>
                                    <input type="text" class="form-control input-solid" id="nama" placeholder="Nama Mahasiswa" value=""  readonly>

                                    <label for="department">Email</label>
                                    <input type="text" class="form-control input-solid" id="email" placeholder="Email" value="" readonly>

                                    <label for="work_unit">No. Hp</label>
                                    <input type="text" class="form-control input-solid" id="no_hp" placeholder="No.Hp" value="" readonly>
                                </div>
                            </div>
                        </div>
                        <div id="month" style="display: none;">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="date">@lang('Month')</label>
                                        {!! Azk::monthDropdown() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="specific" style="display: none;">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                    <label for="date">@lang('Tanggal Awal')</label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text">
                                              <i class="far fa-calendar-alt"></i>
                                            </span>
                                          </div>
                                            <input type="date"
                                                   class="form-control input-solid"
                                                   name="date_from"
                                                   id="date_from">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                    <label for="date">@lang('Tanggal Akhir')</label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text">
                                              <i class="far fa-calendar-alt"></i>
                                            </span>
                                          </div>
                                            <input type="date"
                                                   class="form-control input-solid"
                                                   name="date_until"
                                                   id="date_until" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submitbtn" class="btn btn-primary" >Report</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
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
        $("#datatable").DataTable();
    });
</script>
<script>
    $('#customRadio1').click(function(){
        if(this.checked){
            $('#mahasiswa').hide();
            $('#specific').hide();
            $('#month').hide();
        }
    });
    $('#customRadio2').click(function(){
        if(this.checked){
            $('#mahasiswa').show();
            $('#specific').hide();
            $('#month').hide();
        }
        else
        {
            $('#mahasiswa').hide();
        }
    });
    $('#customRadio3').click(function(){
        if(this.checked){
            $('#month').show();
            $('#specific').hide();
            $('#mahasiswa').hide();
        }
        else
        {
            $('#month').hide();
        }
    });
    $('#customRadio4').click(function(){
        if(this.checked){
            $('#specific').show();
            $('#mahasiswa').hide();
            $('#month').hide();
        }
        else
        {
            $('#specific').hide();
        }
    });
</script>
<script type="text/javascript">
    let timer;
    $('#nim').keyup(function () {
        $('#id').val('');
        $('#nama').val('');
        $('#email').val('');
        $('#no_hp').val('');
        let val = $(this).val();
        clearTimeout(timer);
        timer = setTimeout(function () {
            $.ajax({
                url: '{{ url('operational/transaksi/get-mahasiswa') }}',
                data: {
                    nim: val
                },
                type: 'get',
                dataType: 'json',
                beforeSend: function () {
                    $('#ic').html('<i class="fa fa-refresh fa-spin"></i>');
                },
                success: function (res) {
                    if (res.code == 200) {
                        nimMahasiswa = document.getElementById('nim').value;
                        $('#id').val(res.data.id);
                        $('#nama').val(res.data.nama);
                        $('#email').val(res.data.email);
                        $('#no_hp').val(res.data.no_hp);
                        $('#txt_valid').hide();
                        $('#nim').removeClass('is-invalid').addClass('is-valid');
                    }
                    $('#ic').html('<i class="fa fa-user"></i>');
                },
                error: function () {
                    // body...
                    alert('server not respon');
                    $('#ic').html('<i class="fa fa-user"></i>');
                }
            })
        }, 1000)
    });
</script>
<script type="text/javascript">
  $('.form-control[name=date_from]').change(function() {
      var datearray = $('#date_from').val().split("-");
      var minDate = (datearray[0] +"-"+ datearray[1] +"-"+ datearray[2]);
      document.getElementById('date_until').setAttribute("min", minDate);
      document.getElementById('date_until').disabled=false;
    });
</script>
<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {
      let min = new Date();
      max = new Date();
      day_min = 1,
      day_max = 31,
      month_min = 1,
      month_max = 12,
      year = min.getFullYear();

      if(day_min<10){
        day_min='0'+day_min
      } 
      if(month_min<10){
        month_min='0'+month_min
      }
      min = year+'-'+month_min+'-'+day_min;
      max = year+'-'+month_max+'-'+day_max
      document.getElementById('date_from').setAttribute("min", min);
      document.getElementById('date_from').setAttribute("max", max);
      document.getElementById('date_until').setAttribute("min", min);
      document.getElementById('date_until').setAttribute("max", max);
    }, false);
</script> 
<script>
    $().ready(function() {
    $('#clicker').click(function() {
        $('input').each(function() {
            if ($(this).attr('disabled')) {
                $(this).removeAttr('disabled');
            }
            else {
                $(this).attr({
                    'disabled': 'disabled'
                });
            }
        });
    });
});
</script>
@endsection
