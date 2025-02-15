
@extends('admin.layouts.master')
@section('page')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ trans('Edit Country') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.countries.update',$country->id) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="text" name="id" value="{{$country->id}}">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ trans('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $country->name }}"  required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="code" class="col-md-4 col-form-label text-md-right">{{ trans('code') }}</label>

                            <div class="col-md-6">
                                <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') ?? $country->code }}" required autocomplete="code" autofocus>

                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="active" class="col-md-4 col-form-label text-md-right">{{ trans('Status') }}</label>
                            <div class="col-md-6">
                                <select class="custom-select my-select" name="active">
                                    @foreach($activees as $active)
                                        <option value="{{$active}}" @if($active==$country->active) selected @endif>
                                            @if($active==0)
                                                InActive
                                            @else
                                                Active
                                            @endif
                                        </option>
                                        @endforeach
                                    </select>
                                @error('active')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="mb-0 form-group row">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('Edit') }}
                                </button>

                             
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 
    
</div>
<script>
    $(document).ready(function(){
              var multipleCancelButton = new Choices('#choices-multiple-remove-button-in-edit', {
              removeItemButton: true,
              maxItemCount:5,
              searchResultLimit:5,
              renderChoiceLimit:5
              });
          });
   </script>
@stop