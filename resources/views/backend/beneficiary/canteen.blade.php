@extends('layouts.masters.backend')
{{-- @section('title', 'Profile') --}}
@section('content')

    <div class="pagetitle">
        <h1>Canteen</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ URL::to(Auth::getDefaultDriver()) }}">Home</a></li>
                <li class="breadcrumb-item active">Canteen</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <div class="main" id="main">
            <div class="row">

                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif

                @if ($a == 0)
                    <div class="col-md-5">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Update Canteen</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ url('permanent/update-canteen/' . $canteen->id) }}" method="POST">
                                @csrf

                                <input type="hidden" name="user_id"
                                    value="{{ Auth()->user()->id ? Auth()->user()->id : '' }}">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="item_code_no"> Item Code No</label>
                                        <input type="text"
                                            class="form-control @error('item_code_no') border border-danger @enderror"
                                            id="item_code_no" placeholder="Enter item code no" name="item_code_no"
                                            value="{{ $canteen->item_code_no }}">
                                        @error('item_code_no')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="item_name">Item Name</label>
                                        <input type="text"
                                            class="form-control  @error('item_name') border border-danger @enderror"
                                            id="item_name" name="item_name" placeholder="Enter item name"
                                            value="{{ $canteen->item_name }}">
                                        @error('item_name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <input type="text"
                                            class="form-control @error('quantity') border border-danger @enderror"
                                            id="quantity" name="quantity" placeholder="Enter quantity"
                                            value="{{ $canteen->quantity }}">
                                        @error('quantity')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="text"
                                            class="form-control @error('quantity') border border-danger @enderror"
                                            id="price" name="price" placeholder="Enter price"
                                            value="{{ $canteen->price }}">
                                        @error('price')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Unit</label>
                                        <select name="Unit" class="form-control">
                                            <option value="">Select...</option>
                                            <option value="kg">kg</option>
                                            <option value="litre">litre</option>
                                            <option value="packet">packet</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    dsfsdfdsfdsf
                    <!-- Main content -->
                    <section class="content">

                        <div class="container-fluid">
                            <div class="row">
                                <!-- left column -->
                                {{-- Update canteen  --}}

                                <div class="col-md-5">
                                    <!-- general form elements -->
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Add Canteen</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <!-- form start -->
                                        <form action="{{ url('permanent/store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="user_id"
                                                value="{{ Auth()->user()->id ? Auth()->user()->id : '' }}">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="item_code_no">Item Code No</label>
                                                    <input type="text"
                                                        class="form-control @error('item_code_no') border border-danger @enderror"
                                                        id="item_code_no" placeholder="Enter code no" name="item_code_no">
                                                    @error('item_code_no')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="item_name">Item Name</label>
                                                    <input type="text"
                                                        class="form-control  @error('item_name') border border-danger @enderror"
                                                        id="item_name" name="item_name" placeholder="Enter item name">
                                                    @error('item_name')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="quantity">Quantity</label>
                                                    <input type="text"
                                                        class="form-control @error('quantity') border border-danger @enderror"
                                                        id="quantity" name="quantity" placeholder="Enter quantity">
                                                    @error('quantity')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="price">Price</label>
                                                    <input type="text"
                                                        class="form-control @error('price') border border-danger @enderror"
                                                        id="price" name="price" placeholder="Enter price">
                                                    @error('price')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="unit">Unit</label>
                                                    <input type="text"
                                                        class="form-control @error('unit') border border-danger @enderror"
                                                        id="unit" name="unit" placeholder="Enter unit">
                                                    @error('unit')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>


                                            </div>
                                            <!-- /.card-body -->
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>

                                <!--/.col (left) -->
                                {{-- /Update canteen  --}}

                                <!--/.col (left) -->
                @endif
                <!-- right column -->
                <div class="col-md-7">
                    <!-- Form Element sizes -->
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">List Canteen </h3>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <div class="card">
                        {{-- <div class="card-header">
                  <h3 class="card-title">DataTable with default features</h3>
                </div> --}}
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Item Code No</th>
                                        <th>Item Name </th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Unit</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Check canteen data is null or n't null --}}
                                    @if ($a == 1 || $a == 0)
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($canteen_l as $item)
                                            <tr>
                                                <td> {{ $i }}</td>
                                                <td>{{ $item->item_code_no }}</td>
                                                <td>{{ $item->item_name }} </td>
                                                <td> {{ $item->quantity }}</td>
                                                <td> {{ $item->price }}</td>
                                                <td> {{ $item->unit }}</td>

                                                <td>

                                                    <a class="btn btn-primary"
                                                        href="{{ URL::to('/' . Auth::getDefaultDriver() . '/canteen/' . $item->id) }}"><i
                                                            class="fa fa-edit"></i></a>

                                                    <a class="btn btn-danger" onclick="return confirm('Are you sure?')"
                                                        href="{{ url('permanent/canteen-destroy', $item->id) }}"><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

    </section>
    <!-- /.content -->
