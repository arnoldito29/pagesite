@extends('layouts.pages')

@section('content')

<section class="find-a-ride">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                {{Auth::user()->name}} 
                {{Auth::user()->surname}} 
            </div>
            <form action="{{ URL::current() }}" method="post" enctype="multipart/form-data">
                <div id="file-uploader" style="width: 300px; height: 200px;">
                    <noscript>
                        <p>Please enable JavaScript to use file uploader.</p>
                    </noscript>
                </div>
                <input type="hidden" name="image" value="" id="user_image" />
                <input type="submit" value="submit" />
            </form>
        </div>
    </div>
</section>
@endsection