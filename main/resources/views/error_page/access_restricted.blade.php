@extends('layouts/mainapp')
@section('content')
<section class="content">

          <div class="error-page">
            <h2 class="headline text-red">404</h2>
            <div class="error-content">
              <h3><i class="fa fa-warning text-red"></i> Oops! Access Denied.</h3>
              <p><big><big><big>
                You have no access to this page. <a href="{{url('/')}}">Try to Login Different Account</a></big></big></big>
              </p>
            </div>
          </div><!-- /.error-page -->

        </section>
@endsection