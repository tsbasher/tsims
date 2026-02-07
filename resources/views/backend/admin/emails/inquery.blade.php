<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'TSIMS') }} | Inquery Details</title>

</head>

<body class="control-sidebar-slide-open layout-navbar-fixed layout-fixed layout-footer-fixed">
    <div class="wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">


                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <br>
                            <br>
                            <h2 style="text-align:center">Product Inquery </h2>
                            <br>
                            <br>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">

                                    <address>
                                        Name: <strong>{{ $inquery->name }}</strong><br>
                                        Company: {{ $inquery->company ? $inquery->company : '' }}<br>
                                        Phone: {{ $inquery->phone }}<br>
                                        Email: {{ $inquery->email }}
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-5 invoice-col">

                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 invoice-col text-left">
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                            <br>
                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table style="width:100%; border-collapse: collapse;" border="1">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Code</th>
                                                <th>Product</th>
                                                <th class="text-center">Group</th>
                                                <th class="text-center">Category</th>
                                                <th class="text-center">Subcategory</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($inquery->details as $p)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $p->product->code }}</td>
                                                    <td>{{ $p->product->name }}</td>
                                                    <td class="text-center">{{ $p->product->group->name }}</td>
                                                    <td class="text-center">{{ $p->product->category->name }}</td>
                                                    <td class="text-center">{{ $p->product->subCategory ? $p->product->subCategory->name : '' }}</td>

                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>

                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row mt-4">
                                <h5>Message:</h5>
                                <p>{{ $inquery->message }}</p>
                            </div>

                        </div>
                        <!-- /.invoice -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
</body>

</html>
