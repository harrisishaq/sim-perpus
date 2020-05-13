@extends('layouts.app')

@section('styles')
    <!-- Select2 -->
    <link rel="stylesheet" type="text/css" href="{{ asset(('plugins/select2/css/select2.min.css')) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')) }}">
@stop

@section('page-heading', $edit ? 'Bayar Denda' : __('Bayar Denda'))

@section('content')

@include('partials.messages')

<section class="content">
    <div class="row">
        <div class="col-12">
@if ($edit)
    {!! Form::open(['url' => 'operational/denda/'.$data->id.'/bayar', 'method' => 'PUT', 'id' => 'form']) !!}
@endif
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card-title">
                              <h5>
                                <strong>
                                    @lang('Pembayaran Denda')
                                </strong>
                              </h5>
                              <p class="description text-sm">
                                @lang('Isikan data tanggal pembayaran denda dari buku yang dipinjam.')
                              </p>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                              <label for="nim">Nomor Induk Mahasiswa (NIM)</label>
                              <input type="hidden" name="mahasiswas_id" id="id" value="{{ $edit ? $data->mahasiswas_id : old('mahasiswas_id') }}">
                              <div class="input-group">
                                  <input type="text" class="form-control" placeholder="Nomor Induk Mahasiswa (NIM)" id="nim" name="nim" aria-describedby="ic" value="{{ $edit ? $mahasiswa->nim : old('nim') }}" autocomplete="off" required readonly>
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
                                <select class="form-control select2" name="bukus_id" style="width: 100%; height: auto;" autocomplete="off" disabled>
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
                                               required readonly>
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
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="date">@lang('Tanggal Kembali')</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <i class="far fa-calendar-alt"></i>
                                        </span>
                                      </div>
                                      <input type="date" class="form-control input-solid" name="date_returned" id="date_returned" value="{{ $edit ? $data->date_returned : old('date_returned') }}" required readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="date">@lang('Tanggal Bayar')</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <i class="far fa-calendar-alt"></i>
                                        </span>
                                      </div>
                                      <input type="date" class="form-control input-solid" name="date_paid" id="date_paid" required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-left">
                                {{ __($edit ? 'Bayar' : 'Create') }}
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
  document.addEventListener('DOMContentLoaded', function() {
      var datearray = $('#date_returned').val().split("-");
      var minDate = (datearray[0] +"-"+ datearray[1] +"-"+ datearray[2]);
      document.getElementById('date_paid').setAttribute("min", minDate);
    }, false);
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
