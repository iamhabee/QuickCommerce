@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'order'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="row p-5 align-items-center">
                        <div class="col-8">
                            <h4 class="mb-0">All Order</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('order.create') }}" class="btn btn-sm btn-primary">Add order</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                        Order
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
                                        Discount Price
                                    </th>
                                    <th >
                                        Status
                                    </th>
                                    <th >
                                        Action
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>
                                                {{ $user->product_name}}
                                            </td>
                                            <td>
                                                {{ $user->product_category}}
                                            </td>
                                            <td>
                                                {{ $user->product_quantity}}
                                            </td>
                                            <td class="text-right">
                                                {{ $user->product_price}}
                                            </td>
                                            <td class="text-right">
                                                {{ $user->product_discount_price}}
                                            </td>
                                            <td>
                                                {{ $user->product_status}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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