@extends('admin.admin_master')
@section('admin')
    <!-- Content Body Start -->
    <!-- Page Headings Start -->
    <div class="row justify-content-between align-items-center mb-10">

    </div><!-- Page Headings End -->

    <div class="row mbn-30">
        <!-- Recent Transaction Start -->
        <div class="col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h4 class="title">Recent Transaction</h4>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-vertical-middle table-selectable">

                            <!-- Table Head Start -->
                            <thead>
                                <tr>
                                    <th class="selector"><label class="adomx-checkbox"><input type="checkbox"> <i
                                                class="icon"></i></label></th>
                                    <!--<th class="selector h5"><button class="button-check"></button></th>-->
                                    <th><span>Image</span></th>
                                    <th><span>Product Name</span></th>
                                    <th><span>ID</span></th>
                                    <th><span>Quantity</span></th>
                                    <th><span>Price</span></th>
                                    <th><span>Status</span></th>
                                    <th></th>
                                </tr>
                            </thead><!-- Table Head End -->

                            <!-- Table Body Start -->
                            <tbody>
                                <tr>
                                    <td class="selector"><label class="adomx-checkbox"><input type="checkbox"> <i
                                                class="icon"></i></label></td>
                                    <td><img src="{{ asset('backend/images/product/list-product-1.jpg') }}" alt=""
                                            class="table-product-image rounded-circle"></td>
                                    <td><a href="#">Microsoft surface pro 4</a></td>
                                    <td>#MSP40022</td>
                                    <td>05 - Products</td>
                                    <td>$60000000.00</td>
                                    <td><span class="badge badge-success">Paid</span></td>
                                    <td><a class="h3" href="#"><i class="zmdi zmdi-more"></i></a>
                                    </td>
                                </tr>
                                <tr class="selected">
                                    <td class="selector"><label class="adomx-checkbox"><input type="checkbox"> <i
                                                class="icon"></i></label></td>
                                    <td><img src="{{ asset('backend/images/product/list-product-2.jpg') }}" alt=""
                                            class="table-product-image rounded-circle"></td>
                                    <td><a href="#">Microsoft surface pro 4</a></td>
                                    <td>#MSP40022</td>
                                    <td>05 - Products</td>
                                    <td>$60000000.00</td>
                                    <td><span class="badge badge-success">Paid</span></td>
                                    <td><a class="h3" href="#"><i class="zmdi zmdi-more"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="selector"><label class="adomx-checkbox"><input type="checkbox"> <i
                                                class="icon"></i></label></td>
                                    <td><img src="{{ asset('backend/images/product/list-product-3.jpg') }}" alt=""
                                            class="table-product-image rounded-circle"></td>
                                    <td><a href="#">Microsoft surface pro 4</a></td>
                                    <td>#MSP40022</td>
                                    <td>05 - Products</td>
                                    <td>$60000000.00</td>
                                    <td><span class="badge badge-warning">Due</span></td>
                                    <td><a class="h3" href="#"><i class="zmdi zmdi-more"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="selector"><label class="adomx-checkbox"><input type="checkbox">
                                            <i class="icon"></i></label></td>
                                    <td><img src="{{ asset('backend/images/product/list-product-4.jpg') }}" alt=""
                                            class="table-product-image rounded-circle"></td>
                                    <td><a href="#">Microsoft surface pro 4</a></td>
                                    <td>#MSP40022</td>
                                    <td>05 - Products</td>
                                    <td>$60000000.00</td>
                                    <td><span class="badge badge-danger">Reject</span></td>
                                    <td><a class="h3" href="#"><i class="zmdi zmdi-more"></i></a>
                                    </td>
                                </tr>
                            </tbody><!-- Table Body End -->

                        </table>
                    </div>
                </div>
            </div>
        </div><!-- Recent Transaction End -->

    </div>

    <!-- Content Body End -->
@endsection
