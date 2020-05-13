@extends('layouts.app')

@section('page-heading', $edit ? 'Edit Mahasiswa' : __('Add Mahasiswa'))

@section('content')

@include('partials.messages')

<section class="content">
    <div class="row">
        <div class="col-12">
@if ($edit)
    {!! Form::open(['url' => 'mdata/mahasiswa/'.$data->id.'/edit', 'method' => 'PUT', 'id' => 'form']) !!}
@else
    {!! Form::open(['url' => 'mdata/mahasiswa/create', 'id' => 'form']) !!}
@endif
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card-title">
                                <h5>
                                    <strong>
                                        @lang('Mahasiswa Detail')
                                    </strong>
                                </h5>
                                <p class="description text-sm">
                                    @lang('Informasi umum tentang Mahasiswa.')
                                </p>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="nim">@lang('NIM')</label>
                                <input type="hidden" name="id" id="id" value="{{ $edit ? $data->id : old('id') }}">
                                <input type="text" class="form-control input-solid" id="nim" name="nim" placeholder="@lang('NIM')" value="{{ $edit ? $data->nim : old('nim') }}" required autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="nama">@lang('Nama')</label>
                                <input type="text" class="form-control input-solid" id="nama" name="nama" placeholder="@lang('Nama')" value="{{ $edit ? $data->nama : old('nama') }}" required autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="email">@lang('Email')</label>
                                <input type="email" class="form-control input-solid" id="email" name="email" placeholder="@lang('Email')" value="{{ $edit ? $data->email : old('email') }}" required autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="no_hp">@lang('No. Hp')</label>
                                <input type="number" class="form-control input-solid" id="no_hp" name="no_hp" placeholder="@lang('No. Hp')" value="{{ $edit ? $data->no_hp : old('no_hp') }}" required autocomplete="off">
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

