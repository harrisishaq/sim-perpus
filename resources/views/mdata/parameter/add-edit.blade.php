@extends('layouts.app')

@section('styles')
@stop

@section('page-heading', $edit ? 'Edit Parameter' : __('Add Parameter'))

@section('content')

@include('partials.messages')

<section class="content">
    <div class="row">
        <div class="col-12">
@if ($edit)
    {!! Form::open(['url' => 'mdata/parameter/'.$data->id.'/edit', 'method' => 'PUT', 'id' => 'form']) !!}
@else
    {!! Form::open(['url' => 'mdata/parameter/create', 'id' => 'form']) !!}
@endif
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h5 class="card-title">
                                <strong>
                                    @lang('Parameter Detail')
                                </strong>
                            </h5>
                            <p class="description text-sm">
                                <br>
                                @lang('Informasi umum tentang Parameter. Parameter adalah nilai yang dapat digunakan sebagai nilai dasar dari suatu data.')
                            </p>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                              <label for="denda">@lang('Biaya Denda')</label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">Rp </span>
                                </div>
                                <input type="text" class="form-control input-solid" id="denda" name="denda" placeholder="@lang('Biaya Denda')" value="{{ $edit ? $data->denda : old('denda') }}" required>
                                <div class="input-group-append">
                                  <span class="input-group-text">/ Hari</span>
                                </div>
                              </div>
                          </div>
                          <div class="form-group">
                            <label for="pinjam">@lang('Batas Hari Peminjaman')</label>
                            <div class="input-group">
                              <input type="number" class="form-control input-solid" id="hari_pinjam" name="hari_pinjam" placeholder="@lang('Batas Hari')" value="{{ $edit ? $data->hari_pinjam : old('hari_pinjam') }}" required>
                              <div class="input-group-append">
                                <span class="input-group-text">Hari</span>
                              </div>
                            </div>
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
