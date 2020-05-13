@extends('layouts.app')

@section('styles')
    <!-- Select2 -->
    <link rel="stylesheet" type="text/css" href="{{ asset(('plugins/select2/css/select2.min.css')) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')) }}">
@stop

@section('page-heading', $edit ? 'Edit Transaksi Peminjaman' : __('Tambah Transaksi Peminjaman'))

@section('content')

@include('partials.messages')

<section class="content">
    <div class="row">
        <div class="col-12">
@if ($edit)
    {!! Form::open(['url' => 'operational/transaksi/'.$data->id.'/edit', 'method' => 'PUT', 'id' => 'form']) !!}
@else
    {!! Form::open(['url' => 'operational/transaksi/create', 'id' => 'form']) !!}
@endif
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card-title">
                              <h5>
                                <strong>
                                    @lang('Peminjaman Buku')
                                </strong>
                              </h5>
                              <p class="description text-sm">
                                @lang('Isikan data - data yang diperlukan untuk melakukan peminjaman buku.')
                              </p>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                              <label for="nim">Nomor Induk Mahasiswa (NIM)</label>
                              <input type="hidden" name="mahasiswas_id" id="id" value="{{ $edit ? $data->mahasiswas_id : old('mahasiswas_id') }}">
                              <div class="input-group">
                                  <input type="text" class="form-control" placeholder="Nomor Induk Mahasiswa (NIM)" id="nim" name="nim" aria-describedby="ic" value="{{ $edit ? $mahasiswa->nim : old('nim') }}" autocomplete="off" required>
                                  <div class="input-group-append">
                                      <span class="input-group-text" id="ic">
                                          <i class="fa fa-user"></i>
                                      </span>
                                  </div>
                              </div>
                              <small class="text-danger font-italic" id="txt_valid" style="display: none;">NIM not valid.</small>
                          </div>
                          <div class="form-group row">
                              <div class="col-sm-6">
                                  <label for="nama">Nama</label>
                                  <input type="text"
                                         class="form-control input-solid"
                                         name="nama"
                                         id="nama"
                                         placeholder="Nama Mahasiswa"
                                         value="{{ $edit ? $mahasiswa->nama : old('nama') }}" autocomplete="off" required readonly>
                              </div>
                              <div class="col-sm-6">
                                  <label for="no_hp">No. Hp</label>
                                  <input type="text"
                                         class="form-control input-solid"
                                         name="no_hp"
                                         id="no_hp"
                                         placeholder="Nomor Hp Mahasiswa"
                                         value="{{ $edit ? $mahasiswa->no_hp : old('no_hp') }}" autocomplete="off" required readonly>
                              </div>
                          </div>
                            <div class="form-group">
                                <label for="nama_buku">@lang('Judul Buku')</label>
                                <select class="form-control select2" name="bukus_id" style="width: 100%; height: auto;" autocomplete="off">
                                    <option selected value="">Input Judul Buku</option>
                                    @foreach ($buku as $d)
                                        <option value="{{ $d->id }}" {{ $edit ? ($d->id == $data->bukus_id ? 'selected' : '') : '' }} >{{ $d->nama_buku }} (Diterbitkan oleh {{ $d->penerbit->nama }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="date">@lang('Tanggal Pinjam')</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <i class="far fa-calendar-alt"></i>
                                        </span>
                                      </div>
                                        <input type="date"
                                               class="form-control input-solid"
                                               name="date_from"
                                               id="date_from" 
                                               value="{{ $edit ? $data->date_from : old('date_from') }}"
                                               required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="date">@lang('Batas Tanggal Kembali')</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <i class="far fa-calendar-alt"></i>
                                        </span>
                                      </div>
                                      <input type="date" class="form-control input-solid" name="date_until" id="date_until" value="{{ $edit ? $data->date_until : old('date_until') }}" required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                              <label for="description">@lang('Note')</label>
                              <textarea name="description"
                                              id="description"
                                              class="form-control input-solid" placeholder="Note" required>{{ $edit ? $data->description : old('description') }}</textarea>
                                            </div>
                            <button type="submit" class="btn btn-primary float-left">
                                {{ __($edit ? 'Update' : 'Create') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop
@section('scripts')
<script src="{{ asset (('plugins/select2/js/select2.full.min.js')) }}"></script>
<script type="text/javascript">
  let timer;
  $('#nim').keyup(function() {
    $('#id').val('');
    $('#nama').val('');
    $('#no_hp').val('');
    $('#nim').addClass('is-invalid');
    $('button[type=submit]').prop('disabled', true);

    let val = $(this).val();
    clearTimeout(timer);
    timer = setTimeout(function () {
      $.ajax({
        url: '{{ url('operational/transaksi/get-mahasiswa') }}',
        data: {nim: val},
        type: 'get',
        dataType: 'json',
        beforeSend: function () {
          $('#ic').html('<i class="fas fa-sync-alt"></i>');
        },
        success: function (res) {
          if(res.code == 200){
            $('#id').val(res.data.id);
            $('#nama').val(res.data.nama);
            $('#no_hp').val(res.data.no_hp);
            $('button[type=submit]').prop('disabled', false);
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
      $.ajax({
        url: '{{ url('operational/transaksi/get-hari') }}',
        type: 'get',
        dataType: 'json',
        success: function (res) {
          var numberOfDaysToAdd = parseInt(res.data.hari_pinjam);
          var date_from = new Date($('#date_from').val());
          var someDate = new Date(date_from);

          someDate.setDate(someDate.getDate() + numberOfDaysToAdd);
          var dd = String(someDate.getDate()).padStart(2, '0');
          var mm = String(someDate.getMonth() + 1).padStart(2, '0');
          var yyyy = someDate.getFullYear();

          var someFormattedDate = (yyyy +"-"+ mm +"-"+ dd);
          document.getElementById('date_until').setAttribute("value", someFormattedDate);
        }
      })
    });
</script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
          theme: 'bootstrap4'
        })
    })
</script>
@endsection
