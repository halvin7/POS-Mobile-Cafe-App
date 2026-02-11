@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center ">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><h3>Dashboard</h3></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row mt-2">

                      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                          <a href="/">
                            <div class="card-icon bg-success">
                              <i class="fas fa-money-bill-wave"></i>
                            </div>
                          </a>
                          
                          <div class="card-wrap">
                            <div class="card-header">
                              <h4>Total Income</h4>
                            </div>
                            <div class="card-body">
                            <?php
                                $sum = 0;
                                foreach($transaction as $key=>$value){
                                $sum = $sum + $value->total;
                                }
                                echo "Rp ";
                                echo number_format($sum);
                                ?>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                          <a href="/">
                            <div class="card-icon bg-success">
                              <i class="fas fa-money-bill-wave"></i>
                            </div>
                          </a>
                          
                          <div class="card-wrap">
                            <div class="card-header">
                              <h4>Last Year</h4>
                            </div>
                            <div class="card-body">
                            <?php
                                $sum = 0;
                                foreach($last365 as $key=>$value){
                                $sum = $sum + $value->total;
                                }
                                echo "Rp ";
                                echo number_format($sum);
                                echo "";
                                ?>
                              
                            </div>
                          </div>
                        </div>
                      </div>                  
                    </div>
                    <div class="row mt-3">
                      <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                          <a href="/">
                            <div class="card-icon bg-success">
                              <i class="fas fa-money-bill-wave"></i>
                            </div>
                          </a>
                          <div class="card-wrap">
                            <div class="card-header">
                              <h4>Last day</h4>
                            </div>
                            <div class="card-body">
                            <?php
                                $sum = 0;
                                foreach($last1 as $key=>$value){
                                $sum = $sum + $value->total;
                                }
                                echo "Rp ";
                                echo number_format($sum);
                                ?>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                          <a href="/">
                            <div class="card-icon bg-success">
                              <i class="fas fa-money-bill-wave"></i>
                            </div>
                          </a>
                          
                          <div class="card-wrap">
                            <div class="card-header">
                              <h4>Last week</h4>
                            </div>
                            <div class="card-body">
                            <?php
                                $sum = 0;
                                foreach($last7 as $key=>$value){
                                $sum = $sum + $value->total;
                                }
                                echo "Rp ";
                                echo number_format($sum);
                                ?>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                          <a href="/">
                            <div class="card-icon bg-success">
                              <i class="fas fa-money-bill-wave"></i>
                            </div>
                          </a>
                          
                          <div class="card-wrap">
                            <div class="card-header">
                              <h4>Last Month</h4>
                            </div>
                            <div class="card-body">
                            <?php
                                $sum = 0;
                                foreach($last30 as $key=>$value){
                                $sum = $sum + $value->total;
                                }
                                echo "Rp ";
                                echo number_format($sum);
                                echo "";
                                ?>
                              
                            </div>
                          </div>
                        </div>
                      </div>                  
                    </div>
                    <div class="row mt-3">
                      
                      <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                          <a href="/">
                            <div class="card-icon bg-info">
                              <i class="fas fa-cubes"></i>
                            </div>
                          </a>
                          <div class="card-wrap">
                            <div class="card-header">
                              <h4>Total Stock</h4>
                            </div>
                            <div class="card-body">
                            <?php
                                $sum = 0;
                                foreach($product as $key=>$value){
                                $sum = $sum + $value->qty;
                                }
                                echo number_format($sum);
                                ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                          <a href="/">
                            <div class="card-icon bg-info">
                              <i class="fas fa-hamburger"></i>
                            </div>
                          </a>
                          <div class="card-wrap">
                            <div class="card-header">
                              <h4>Total Product</h4>
                            </div>
                            <div class="card-body">
                            <?= count($product)?>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                          <a href="/">
                            <div class="card-icon bg-info">
                              <i class="fas fa-book"></i>
                            </div>
                          </a>
                          <div class="card-wrap">
                            <div class="card-header">
                              <h4>Total Category</h4>
                            </div>
                            <div class="card-body">
                            <?= count($category)?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-3">
                           

                      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-danger">
                              <i class="fas fa-hamburger"></i>
                            </div>
                          </a>
                          
                          <div class="card-wrap">
                            <div class="card-header">
                              <h4>Product Sold</h4>
                            </div>
                            <div class="card-body">
                            <?php
                                $sum = 0;
                                foreach($producttransaction as $key=>$value){
                                $sum = $sum + $value->qty;
                                }
                                echo number_format($sum);
                                ?>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                          <a href="/">
                            <div class="card-icon bg-danger">
                              <i class="fas fa-file-invoice-dollar"></i>
                            </div>
                          </a>
                          
                          <div class="card-wrap">
                            <div class="card-header">
                              <h4>Total Transaction</h4>
                            </div>
                            <div class="card-body">
                            <?= count($transaction)?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                              <i class="fas fa-id-card"></i>
                            </div>
                          </a>
                          
                          <div class="card-wrap">
                            <div class="card-header">
                              <h4>Total Membership</h4>
                            </div>
                            <div class="card-body">
                            <?= count($membership)?>
                            </div>
                          </div>
                        </div>
                      </div>    
                      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                          <a href="/">
                            <div class="card-icon bg-primary">
                              <i class="fas fa-users"></i>
                            </div>
                          </a>
                          
                          <div class="card-wrap">
                            <div class="card-header">
                              <h4>Total Cashier</h4>
                            </div>
                            <div class="card-body">
                            <?= $cashier = count($user)-3 ?>
                            </div>
                          </div>
                        </div>
                      </div>                  
                    </div>

                    

                   

                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
