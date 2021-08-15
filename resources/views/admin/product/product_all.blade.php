@extends('admin.admin_master')
@section('admin')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">            
            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border">
                    <h3 class="box-title">Category Lists</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                <thead>
                                    <tr>
                                        <td>Image</td>
                                        <td>Product English</td>
                                        <td>Quantity</td>                                        
                                        <td>Price</td>
                                        <td>Discount</td>                                        
                                        <td>status</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $item)
                                    <tr>
                                        <td>
                                            <img src="{{ asset($item->product_thumbnail) }}" style="height:50px; width:60px;" alt="product image">
                                        </td>
                                        <td>{{$item->product_name_en}}</td>                                        
                                        <td>{{$item->product_qty}}</td>
                                        <td>${{$item->selling_price}}</td>
                                        <td>
                                        @if ($item->discount_price == NULL)
                                            <span class="badge badge-pill badge-danger"> No Discount </span>
                                            @else
                                            @php
                                            $amount = (($item->selling_price - $item->discount_price)/$item->selling_price) * 100;
                                            @endphp
                                            <span class="badge badge-pill badge-danger"> {{ round($amount)}}% </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status == 1)
                                            <span class="badge badge-pill badge-success">Active </span>
                                            @else                                            
                                            <span class="badge badge-pill badge-danger"> InActive </span>
                                            @endif
                                        </td>
                                        
                                        <td width="27%">
                                            <a href="{{route('product.edit',$item->id)}}" class="btn btn-primary" title="Product Details"><i class="fa fa-eye"></i></a>
                                            <a href="{{route('product.edit',$item->id)}}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a href="{{route('product.delete',$item->id)}}" id="delete" class="btn btn-danger" title="Delete Data"><i class="fa fa-trash"></i></a>
                                            @if ($item->status == 1)
                                            <a href="{{route('product.inactive',$item->id)}}" class="btn btn-danger" title="Inactive Now"><i class="fa fa-arrow-down"></i></a>
                                            @else
                                            <a href="{{ route('product.active',$item->id) }}" class="btn btn-success" title="Active Now"><i class="fa fa-arrow-up"></i> </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>
            <!-- /.col -->
            
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->	  
</div>
@endsection
