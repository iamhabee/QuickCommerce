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
                            <h4 class="mb-0">All Variant</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                         Price
                                    </th>
                                    <th>
                                        Discount
                                    </th>
                                    <th>
                                        Bulk Price
                                    </th>
                                    <th>
                                        Color
                                    </th>
                                    <th >
                                        Size
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach($variant as $user)
                                        <tr>
                                            <td>
                                            &#8358; {{ $user->variant_price}}
                                            </td>
                                            <td>
                                            &#8358; {{$user->variant_discount_price }}
                                            </td>
                                            <td>
                                            &#8358; {{ $user->variant_bulk_price}}
                                            </td>
                                            <td>
                                                {{ $user->variant_colour}}
                                            </td>
                                            <td >
                                                {{ $user->variant_size}}
                                            </td>
                                            <td >
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