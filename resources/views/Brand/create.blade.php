@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'brand'
])

@section('content')

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form action="{{ route('brand.store') }}" name="demoform" id="demoform" method="POST">
          @csrf
            <div class="row">
              <label class="col-sm-2 col-form-label">{{ __('Brand Name') }}</label>
              <div class="col-sm-7">
                <div class="form-group{{ $errors->has('brand_name') ? ' has-danger' : '' }}">
                  <input class="form-control{{ $errors->has('brand_name') ? ' is-invalid' : '' }}" name="brand_name" id="input-name" type="text" placeholder="{{ __('Product Name') }}" value="{{ old('brand_name') }}" required="true" aria-required="true"/>
                  @if ($errors->has('brand_name'))
                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('brand_name') }}</span>
                  @endif
                </div>
              </div>
            </div>
          <div class="card-footer ml-auto mr-auto">
            <button type="submit" class="btn btn-warning">{{ __('Add Brand') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection