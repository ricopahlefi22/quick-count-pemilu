@extends('owner.template.base')

@section('content')
    <div class="page-content">
        @include('sections.dashboard.index')

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h5 class="page-title mb-0 font-size-18">Pemetaan Suara</h5>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <a href="">Lebih Lengkap <i class="fa fa-arrow-right"></i></a>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <p class="mb-2">Jumlah Pendukung</p>
                                <h4 class="mb-0">{{ $self_voters_count }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
