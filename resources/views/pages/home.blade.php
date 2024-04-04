@extends('layouts.dashboard')
@section('content')
    {{-- <h1 class="text-center">Selamat Datang {{ Auth::user()->name }}</h1> --}}
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ Auth::user()->name }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-edit"></i></span>
    
                <div class="info-box-content">
                  <span class="info-box-text">POST</span>
                  <span class="info-box-number">{{ $posts }}<small></small></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-photo"></i></span>
    
                <div class="info-box-content">
                  <span class="info-box-text">PHOTO</span>
                  <span class="info-box-number">{{ $photos }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
    
            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>
    
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-youtube-play"></i></span>
    
                <div class="info-box-content">
                  <span class="info-box-text">Video</span>
                  <span class="info-box-number">{{ $videos  }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
    
                <div class="info-box-content">
                  <span class="info-box-text">User</span>
                  <span class="info-box-number">{{ $users }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>

    </section> 
@endsection