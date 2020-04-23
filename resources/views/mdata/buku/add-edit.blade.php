@extends('layouts.app')

@section('styles')
    <!-- Select2 -->
    <link rel="stylesheet" type="text/css" href="{{ asset(('plugins/select2/css/select2.min.css')) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')) }}">
@stop

@section('page-heading', $edit ? 'Edit Buku' : __('Add Buku'))

@section('content')

@include('partials.messages')

<section class="content">
    <div class="row">
        <div class="col-12">
@if ($edit)
    {!! Form::open(['url' => 'mdata/buku/'.$data->id.'/edit', 'method' => 'PUT', 'id' => 'form']) !!}
@else
    {!! Form::open(['url' => 'mdata/buku/create', 'id' => 'form']) !!}
@endif
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h5 class="card-title">
                                <strong>
                                    @lang('Buku Detail')
                                </strong>
                            </h5>
                            <p class="description text-sm">
                                <br>
                                @lang('Informasi umum tentang Buku.')
                            </p>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="kode_buku">@lang('Kode Buku')</label>
                                <input type="hidden" name="id" id="id" value="{{ $edit ? $data->id : old('id') }}">
                                <input type="text" class="form-control input-solid" id="nim" name="kode_buku" placeholder="@lang('Kode Buku')" value="{{ $edit ? $data->kode_buku : old('kode_buku') }}" required autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="nama">@lang('Judul Buku')</label>
                                <input type="text" class="form-control input-solid" id="nama_buku" name="nama_buku" placeholder="@lang('Judul Buku')" value="{{ $edit ? $data->nama_buku : old('nama_buku') }}" required autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="penerbit">@lang('Penerbit')</label>
                                <select class="form-control select2" name="penerbits_id" style="width: 100%; height: auto;">
                                    <option selected value="">Pilih Penerbit</option>
                                    @foreach ($penerbit as $d)
                                        <option value="{{ $d->id }}" {{ $edit ? ($d->id == $data->penerbits_id ? 'selected' : '') : '' }} >{{ $d->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label><strong>Stok Buku</strong></label>
                            <div class="form-group row">
                              <div class="col-sm-6">
                                <label>Tersedia</label>
                                  <input type="text"
                                       class="form-control input-solid"
                                       id="stok_tersedia"
                                       name="stok_tersedia"
                                       placeholder="@lang('Tersedia')"
                                       width="400px" 
                                       value="{{ $edit ? $data->stok_tersedia : old('stok_tersedia') }}" required autocomplete="off">
                              </div>
                              <div class="col-sm-6">
                                <label>Terpinjam</label>
                                  <input type="text"
                                       class="form-control input-solid"
                                       id="stok_terpinjam"
                                       name="stok_terpinjam"
                                       placeholder="@lang('Terpinjam')"
                                       width="400px" 
                                       value="{{ $edit ? $data->stok_terpinjam : 0 }}" required readonly>
                              </div>
                            </div>
                            <!-- @if ($edit)
                              <div class="form-group">
                                  <label for="no_hp">@lang('Status')</label>
                                  <select class="form-control input-solid" id="status" name="status" required>
                                      <option value="">-- Select --</option>
                                      <option value="1" {{ $edit ? ($data->status == 1 ? 'selected' : '') : '' }}>Tersedia</option>
                                      <option value="0" {{ $edit ? ($data->status == 0 ? 'selected' : '') : '' }}>Tidak Tersedia</option>
                                  </select>
                              </div>
                            @endif -->
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
<!-- <script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('stok_terpinjam').setAttribute("value", 0);
    }, false);
</script> -->
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
