<!-- Static navbar -->
<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{$appPath}}">
                <img src="{{ null !== env('PB_APP_IMAGE_URL')
                    ? env('PB_APP_IMAGE_URL')
                    : "http://www.pointblue.org/logos/pointblue_logo_square.jpg"}}"
                     alt="{{env('PB_APP_NAME')}}" class="brand-image img-rounded">
                @yield('title')
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                @include('partials.navbar-routes')
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @include('partials.currentProject')
            </ul>

        </div><!--/.nav-collapse -->

    </div>
</nav>