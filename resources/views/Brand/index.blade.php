@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'brand'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="row p-5 align-items-center">
                        <div class="col-8">
                            <h4 class="mb-0">All Brands</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('brand.create') }}" class="btn btn-sm btn-primary">Add Brand</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Brand Name
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach($brands as $b)
                                        <tr>
                                            <td>
                                                {{ $b->id}}
                                            </td>
                                            <td>
                                                {{ $b->brand_name}}
                                            </td>
                                            <td>
                                            <a rel="tooltip" class="btn btn-success btn-link" href="" data-original-title="" title="">
                                                <i class="material-icons">edit</i>
                                                <div class="ripple-container"></div>
                                            </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection