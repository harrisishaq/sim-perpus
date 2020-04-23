@extends('layouts.app')

@section('page-heading', $edit ? 'Edit Penerbit' : __('Add Penerbit'))

@section('content')

@include('partials.messages')

<section class="content">
    <div class="row">
        <div class="col-12">
@if ($edit)
    {!! Form::open(['url' => 'mdata/penerbit/'.$data->id.'/edit', 'method' => 'PUT', 'id' => 'form']) !!}
@else
    {!! Form::open(['url' => 'mdata/penerbit/create', 'id' => 'form']) !!}
@endif
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h5 class="card-title">
                                <strong>
                                    @lang('Penerbit Detail')
                                </strong>
                            </h5>
                            <p class="description text-sm">
                                <br>
                                @lang('Informasi umum tentang Penerbit.')
                            </p>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="nama">@lang('Nama')</label>
                                <input type="text" class="form-control input-solid" id="nama" name="nama" placeholder="@lang('Nama')" value="{{ $edit ? $data->nama : old('nama') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="no_hp">@lang('Status')</label>
                                <select class="form-control input-solid" id="status" name="status" required>
                                    <option value="">-- Select --</option>
                                    <option value="1" {{ $edit ? ($data->status == 1 ? 'selected' : '') : '' }}>Tersedia</option>
                                    <option value="0" {{ $edit ? ($data->status == 0 ? 'selected' : '') : '' }}>Tidak Tersedia</option>
                                </select>
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

