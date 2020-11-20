@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'product'
])

@section('content')
<?php $tag = explode(',', $data->product_tag);
  $color = explode(',', $data->product_color);
  $size= explode(',', $data->product_size);
?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
        <form action="{{ route('product.update', $data) }}" id="demoform" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
          
            <!-- product name -->
            <div class="row">
              <label class="col-sm-2 col-form-label">{{ __('Product Name') }}</label>
              <div class="col-sm-7">
                <div class="form-group{{ $errors->has('product_name') ? ' has-danger' : '' }}">
                  <input class="form-control{{ $errors->has('product_name') ? ' is-invalid' : '' }}" name="product_name" id="input-name" type="text" placeholder="{{ __('Product Name') }}" value="{{ $data->product_name}}" required="true" aria-required="true"/>
                  @if ($errors->has('product_name'))
                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('product_name') }}</span>
                  @endif
                </div>
              </div>
            </div>
            <!-- description -->
            <div class="row">
              <label class="col-sm-2 col-form-label">{{ __('Product Description') }}</label>
              <div class="col-sm-7">
                <div class="form-group{{ $errors->has('product_description') ? ' has-danger' : '' }}">
                  <textarea class="form-control{{ $errors->has('product_description') ? ' is-invalid' : '' }}" name="product_description" id="input-product_description" type="text" placeholder="{{ __('Product description') }}" value="{{ old('product_description') }}" required="true" aria-required="true">{{$data->production_descrition}}</textarea>
                  @if ($errors->has('product_description'))
                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('product_description') }}</span>
                  @endif
                </div>
              </div>
            </div>
            <!-- product tag -->
            <div class="row">
              <label class="col-sm-2 col-form-label">{{ __('Product Tag') }}</label>
              <div class="col-sm-7">
                <div class="row form-group{{ $errors->has('product_tag') ? ' has-danger' : '' }}">
                
                  <div class="col-10 row" id="tags_list">
                    <div class="tags col-4 mr-2" id="tags">
                      <input class="form-control" name="product_tag[]" id="input-product_tag" type="text" placeholder="{{ __('Product Tag') }}" value="{{ old('product_tag') }}" required="true" aria-required="true"/>
                      <button type="button" class="btn btn-sm btn-outline-danger remove_tag">X</button>
                    </div>
                    @foreach($tag as $t)
                    <div class="tags col-4 mr-2" id="tags">
                      <input class="form-control" name="product_tag[]" id="input-product_tag" type="text" placeholder="{{ __('Product Tag') }}" value="{{ $t}}" required="true" aria-required="true"/>
                      <button type="button" class="btn btn-sm btn-outline-danger remove_tag">X</button>
                    </div>
                    @endforeach
                  </div>
                  <div class="col-2">
                    <button type="button" class="btn btn-sm btn-outline-success" id="add_tag">add</button>
                  </div>

                  @if ($errors->has('product_tag'))
                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('product_tag') }}</span>
                  @endif
                </div>
              </div>
            </div>
            <!-- product quantity -->
            <div class="row">
              <label class="col-sm-2 col-form-label">{{ __('Product Quantity') }}</label>
              <div class="col-sm-7">
                <div class="form-group{{ $errors->has('product_quantity') ? ' has-danger' : '' }}">
                  <input class="form-control{{ $errors->has('product_quantity') ? ' is-invalid' : '' }}" name="product_quantity" id="input-product_quantity" type="number" value="{{ $data->product_quantity}}" required="true" aria-required="true"/>
                  @if ($errors->has('product_quantity'))
                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('product_quantity') }}</span>
                  @endif
                </div>
              </div>
            </div>
            <!-- color -->
            <div class="row">
              <label class="col-sm-2 col-form-label">{{ __('Product Colour') }}</label>
              <div class="col-sm-7">
                <div class="row form-group{{ $errors->has('product_color') ? ' has-danger' : '' }}">
                  
                  <div class="col-10 row" id="colors_list">
                    <div class="color col-2 m-1" id="color">
                      <input class="" name="product_color[]" id="input-product_color" type="color" placeholder="{{ __('Choose color') }}" value="{{ old('product_color') }}" required="true" aria-required="true"/>
                      <button type="button" class="btn btn-sm btn-outline-danger remove_color">X</button>
                    </div>
                    @foreach($color as $c)
                    <div class="color col-2 m-1" id="color">
                      <input class="" name="product_color[]" id="input-product_color" type="color" placeholder="{{ __('Choose color') }}" value="{{$c}}" required="true" aria-required="true"/>
                      <button type="button" class="btn btn-sm btn-outline-danger remove_color">X</button>
                    </div>
                    @endforeach
                  </div>
                  <div class="col-2">
                    <button type="button" class="btn btn-sm btn-outline-success" id="add_color">add</button>
                  </div>
                  
                  @if ($errors->has('product_color'))
                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('product_color') }}</span>
                  @endif
                </div>
              </div>
            </div>
            <!-- product price -->
            <div class="row">
              <label class="col-sm-2 col-form-label">{{ __('Product Price') }}</label>
              <div class="col-sm-7">
                <div class="form-group{{ $errors->has('product_price') ? ' has-danger' : '' }}">
                  <input class="form-control{{ $errors->has('product_price') ? ' is-invalid' : '' }}" name="product_price" id="input-product_price" type="number" value="{{ $data->product_price}}" required="true" aria-required="true"/>
                  @if ($errors->has('product_price'))
                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('product_price') }}</span>
                  @endif
                </div>
              </div>
            </div>
            <!-- discount -->
            <div class="row">
              <label class="col-sm-2 col-form-label">{{ __('Product Discount') }}</label>
              <div class="col-sm-7">
                <div class="form-group{{ $errors->has('product_discount_price') ? ' has-danger' : '' }}">
                  <input class="form-control{{ $errors->has('product_discount_price') ? ' is-invalid' : '' }}" name="product_discount_price" id="input-product_discount_price" type="number" value="{{ $data->product_discount_price }}" required="true" aria-required="true"/>
                  @if ($errors->has('product_discount_price'))
                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('product_discount_price') }}</span>
                  @endif
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">{{ __('Product Size Category') }}</label>
              <div class="col-sm-7">
                <div class="form-group{{ $errors->has('product_size_category') ? ' has-danger' : '' }}">
                    <input class="" name="product_size[]" id="input-product_size" type="checkbox" checked="{{in_array('Sm',$size)?true:false}}" value="Sm" aria-required="true"/> Small
                    <input class="" name="product_size[]" id="input-product_size" type="checkbox" checked="{{in_array('Md',$size)?true:false}}" value="Md" aria-required="true"/> Medium
                    <input class="" name="product_size[]" id="input-product_size" type="checkbox" checked="{{in_array('a',$size)?true:false}}" value="Lg" aria-required="true"/> Large

                  @if ($errors->has('product_size_category'))
                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('product_size_category') }}</span>
                  @endif
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">{{ __('Product Bulk Price') }}</label>
              <div class="col-sm-7">
                <div class="form-group{{ $errors->has('product_bulk_price') ? ' has-danger' : '' }}">
                  <input class="form-control{{ $errors->has('product_bulk_price') ? ' is-invalid' : '' }}" name="product_bulk_price" id="input-product_bulk_price" type="number" placeholder="{{ __('Product Bulk Price') }}" value="{{$data->product_bulk_price}}" required="true" aria-required="true"/>
                  @if ($errors->has('product_bulk_price'))
                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('product_bulk_price') }}</span>
                  @endif
                </div>
              </div>
            </div>
            <div class="card-footer ml-auto mr-auto">
              <button type="submit" class="btn btn-warning">{{ __('Update Product') }}</button>
            </div>
        </form>
        </div>
      </div>
    </div>
  </div>
@endsection
