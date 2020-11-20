@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'product'
])

@section('content')

<div class="content">
  <div class="container-fluid">
    <div class="card ">
      <div class="card-header card-header-warning">
        <h4 class="card-title">{{ __('Add Product') }}</h4>
        <p class="card-category"></p>
      </div>
    </div>
    <!-- <div class="card-body "> -->
    <div class="row">
      <div class="col-md-12">
        <form action="{{ route('product.store') }}" id="demoform" method="POST" enctype="multipart/form-data">
          @csrf
          
          <!-- image -->
            <div class="row">
              <div class="input-group col-md-4">
                <div class="custom-file">
                  <input type="file" name="images[]" multiple class="form-control{{ $errors->has('images') ? ' is-invalid' : '' }}" id="inputGroupFile04" value="{{ old('images') }}" aria-describedby="inputGroupFileAddon04" accept=".png, .jpg, .jpeg">
                </div>
              </div>
            </div>
            <!-- product name -->
            <div class="row">
              <label class="col-sm-2 col-form-label">{{ __('Product Name') }}</label>
              <div class="col-sm-7">
                <div class="form-group{{ $errors->has('product_name') ? ' has-danger' : '' }}">
                  <input class="form-control{{ $errors->has('product_name') ? ' is-invalid' : '' }}" name="product_name" id="input-name" type="text" placeholder="{{ __('Product Name') }}" value="{{ old('product_name') }}" required="true" aria-required="true"/>
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
                  <textarea class="form-control{{ $errors->has('product_description') ? ' is-invalid' : '' }}" name="product_description" id="input-product_description" type="text" placeholder="{{ __('Product description') }}" value="{{ old('product_description') }}" required="true" aria-required="true"></textarea>
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
                  <input class="form-control{{ $errors->has('product_quantity') ? ' is-invalid' : '' }}" name="product_quantity" id="input-product_quantity" type="number" value="{{ old('product_quantity') }}" required="true" aria-required="true"/>
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
                  <input class="form-control{{ $errors->has('product_price') ? ' is-invalid' : '' }}" name="product_price" id="input-product_price" type="number" value="{{ old('product_price') }}" required="true" aria-required="true"/>
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
                  <input class="form-control{{ $errors->has('product_discount_price') ? ' is-invalid' : '' }}" name="product_discount_price" id="input-product_discount_price" type="number" value="{{ old('product_discount_price') }}" required="true" aria-required="true"/>
                  @if ($errors->has('product_discount_price'))
                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('product_discount_price') }}</span>
                  @endif
                </div>
              </div>
            </div>
            <!-- category -->
            <div class="row">
              <label class="col-sm-2 col-form-label">{{ __('Product Category') }}</label>
              <div class="col-sm-7">
                <div class="form-group{{ $errors->has('product_category') ? ' has-danger' : '' }}">
                  <select class="form-control" name="product_category"  data-style="btn btn-link" id="exampleFormControlSelect1" value="{{ old('product_category') }}" required>
                    <option></option>
                    @foreach($category as $c)
                    <option value="{{$c}}">{{$c}}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('product_cateory'))
                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('product_cateory') }}</span>
                  @endif
                </div>
              </div>
            </div>

            <!-- brand -->
            <div class="row">
              <label class="col-sm-2 col-form-label">{{ __('Product Brand') }}</label>
              <div class="col-sm-7">
                <div class="form-group{{ $errors->has('product_brand_id') ? ' has-danger' : '' }}">
                  <select class="form-control" name="product_brand_id"  data-style="btn btn-link" id="exampleFormControlSelect1" value="{{ old('product_brand_id') }}" required>
                    @foreach($brand as $b)
                    <option value="{{$b->id}}">{{$b->brand_name}}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('product_brand_id'))
                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('product_brand_id') }}</span>
                  @endif
                </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 col-form-label">{{ __('Product Size Category') }}</label>
              <div class="col-sm-7">
                <div class="form-group{{ $errors->has('product_size_category') ? ' has-danger' : '' }}">
                    <input class="" name="product_size[]" id="input-product_size" type="checkbox" value="Sm" aria-required="true"/> Small
                    <input class="" name="product_size[]" id="input-product_size" type="checkbox" value="Md" aria-required="true"/> Medium
                    <input class="" name="product_size[]" id="input-product_size" type="checkbox" value="Lg" aria-required="true"/> Large

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
                  <input class="form-control{{ $errors->has('product_bulk_price') ? ' is-invalid' : '' }}" name="product_bulk_price" id="input-product_bulk_price" type="number" placeholder="{{ __('Product Bulk Price') }}" value="{{ old('product_bulk_price') }}" required="true" aria-required="true"/>
                  @if ($errors->has('product_bulk_price'))
                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('product_bulk_price') }}</span>
                  @endif
                </div>
              </div>
            </div>
            
            <div class="card-footer ml-auto mr-auto">
              <button type="submit" class="btn btn-warning">{{ __('Add Product') }}</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection