@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'product'
])

@section('content')
    <div class="content">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="row p-5 align-items-center">
                        <div class="col-8">
                            <h4 class="mb-0">All Product</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('product.create') }}" class="btn btn-sm btn-primary">Add Product</a>
                            <a href="{{ route('product.create_variant') }}" class="btn btn-sm btn-danger">Variant List</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                         Name
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                    <th>
                                        Category
                                    </th>
                                    <th>
                                        Quantity
                                    </th>
                                    <th class="text-right">
                                        Price
                                    </th>
                                    <th class="text-right">
                                        Discount
                                    </th>
                                    <th >
                                        Status
                                    </th>
                                    <th >
                                        Actions
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>
                                                {{ $user->product_name}}
                                            </td>
                                            <td>
                                            @if(strlen($user->product_description) > 100)
                                                {{ substr($user->product_description, 0, 100). "..."}}
                                            @else
                                                {{$user->product_description}}
                                            @endif
                                            </td>
                                            <td>
                                                {{ $user->product_category}}
                                            </td>
                                            <td>
                                                {{ $user->product_quantity}}
                                            </td>
                                            <td >
                                            &#8358; {{ $user->product_price}}
                                            </td>
                                            <td >
                                            &#8358; {{ $user->product_discount_price}}
                                            </td>
                                            <td>
                                                {{ $user->product_status}}
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger">Options</button>
                                                    <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{route('product.edit', $user->id )}}">Edit</a>
                                                        @if($user->product_deleted == 0)
                                                        <form action="{{route('product.destroy', $user->id )}}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="dropdown-item" href="">Delete</button>
                                                        </form>
                                                        @endif
                                                        <button class="dropdown-item" data-toggle="modal" data-target="#staticBackdrop{{$user->id}}" >Variant</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @foreach($users as $u)
            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop{{$u->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">{{$u->product_name}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('product.add_variant') }}" id="demoform" method="POST" enctype="multipart/form-data">
                            @csrf
                                <!-- image -->
                                <div class="row">
                                    <div class="input-group col-md-4">
                                        <div class="custom-file">
                                        <input type="file" name="images[]" multiple class="form-control{{ $errors->has('images') ? ' is-invalid' : '' }}" id="inputGroupFile04" value="{{ old('images') }}" aria-describedby="inputGroupFileAddon04" accept=".png, .jpg, .jpeg">
                                        </div>
                                    </div>
                                </div>

                                <!-- Variant price -->
                                <div class="row">
                                    <label class="col-sm-4 col-form-label">{{ __('Variant Price') }}</label>
                                    <div class="col-sm-8">
                                        <div class="form-group{{ $errors->has('variant_price') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('variant_price') ? ' is-invalid' : '' }}" name="variant_price" id="input-variant_price" type="number" value="{{ old('variant_price') }}" required="true" aria-required="true"/>
                                        <input type="hidden" name="variant_product_id" value="{{$u->id}}"/>
                                        @if ($errors->has('variant_price'))
                                            <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('variant_price') }}</span>
                                        @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- discount -->
                                <div class="row">
                                    <label class="col-sm-5 col-form-label">{{ __('Variant Discount') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('variant_discount_price') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('variant_discount_price') ? ' is-invalid' : '' }}" name="variant_discount_price" id="input-variant_discount_price" type="number" value="{{ old('variant_discount_price') }}" required="true" aria-required="true"/>
                                        @if ($errors->has('variant_discount_price'))
                                            <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('variant_discount_price') }}</span>
                                        @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- bulk price -->
                                <div class="row">
                                    <label class="col-sm-4 col-form-label">{{ __('Variant Bulk Price') }}</label>
                                    <div class="col-sm-8">
                                        <div class="form-group{{ $errors->has('variant_bulk_price') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('variant_bulk_price') ? ' is-invalid' : '' }}" name="variant_bulk_price" id="input-variant_bulk_price" type="number" placeholder="{{ __('variant Bulk Price') }}" value="{{ old('variant_bulk_price') }}" required="true" aria-required="true"/>
                                        @if ($errors->has('variant_bulk_price'))
                                            <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('variant_bulk_price') }}</span>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- color -->
                                <div class="row">
                                    <label class="col-sm-4 col-form-label">{{ __('Variant Colour') }}</label>
                                    <div class="col-sm-8">
                                        <div class="row form-group{{ $errors->has('variant_color') ? ' has-danger' : '' }}">
                                            <input class="" name="variant_color" id="input-variant_color" type="color" placeholder="{{ __('Choose color') }}" value="{{ old('variant_color') }}" required="true" aria-required="true"/>
                                        @if ($errors->has('variant_color'))
                                            <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('variant_color') }}</span>
                                        @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- size -->
                                <div class="row">
                                    <label class="col-sm-4 col-form-label">{{ __('Variant Size') }}</label>
                                    <div class="col-sm-8">
                                        <div class="form-group{{ $errors->has('variant_size_category') ? ' has-danger' : '' }}">
                                            <input class="" name="variant_size[]" id="input-variant_size" type="checkbox" value="Sm" aria-required="true"/> Small
                                            <input class="" name="variant_size[]" id="input-variant_size" type="checkbox" value="Md" aria-required="true"/> Medium
                                            <input class="" name="variant_size[]" id="input-variant_size" type="checkbox" value="Lg" aria-required="true"/> Large

                                        @if ($errors->has('variant_size'))
                                            <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('variant_size') }}</span>
                                        @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer ml-auto mr-auto">
                                    <button type="submit" class="btn btn-primary">{{ __('Add Product') }}</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- <div class="col-md-12">
                <div class="card card-plain">
                    <div class="card-header">
                        <h4 class="card-title"> Table on Plain Background</h4>
                        <p class="card-category"> Here is a subtitle for this table</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Country
                                    </th>
                                    <th>
                                        City
                                    </th>
                                    <th class="text-right">
                                        Salary
                                    </th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            Dakota Rice
                                        </td>
                                        <td>
                                            Niger
                                        </td>
                                        <td>
                                            Oud-Turnhout
                                        </td>
                                        <td class="text-right">
                                            $36,738
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Minerva Hooper
                                        </td>
                                        <td>
                                            Curaçao
                                        </td>
                                        <td>
                                            Sinaai-Waas
                                        </td>
                                        <td class="text-right">
                                            $23,789
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Sage Rodriguez
                                        </td>
                                        <td>
                                            Netherlands
                                        </td>
                                        <td>
                                            Baileux
                                        </td>
                                        <td class="text-right">
                                            $56,142
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Philip Chaney
                                        </td>
                                        <td>
                                            Korea, South
                                        </td>
                                        <td>
                                            Overland Park
                                        </td>
                                        <td class="text-right">
                                            $38,735
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Doris Greene
                                        </td>
                                        <td>
                                            Malawi
                                        </td>
                                        <td>
                                            Feldkirchen in Kärnten
                                        </td>
                                        <td class="text-right">
                                            $63,542
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Mason Porter
                                        </td>
                                        <td>
                                            Chile
                                        </td>
                                        <td>
                                            Gloucester
                                        </td>
                                        <td class="text-right">
                                            $78,615
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Jon Porter
                                        </td>
                                        <td>
                                            Portugal
                                        </td>
                                        <td>
                                            Gloucester
                                        </td>
                                        <td class="text-right">
                                            $98,615
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
@endsection