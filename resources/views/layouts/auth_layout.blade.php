<!DOCTYPE html>
<html lang="en">
@include('partials._head_tag')

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0" style="background: #4B49AC;">
                <div class="row w-100 mx-0">
                    <div class="col-lg-6 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5 rounded">
                            <div class="brand-logo">
                                <h2 class="card-title text-primary text-center">E<sup>share</sup></h2>
                            </div>
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials._script_tag')
</body>

</html>
