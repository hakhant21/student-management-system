@extends('layouts.app')

@section('title','ကျောင်းသားစီမံခန့်ခွဲမှုစနစ်')

@section('content')

@if(!empty($slider))

    <!-- banner section start --->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-xs-12 px-0 py-0">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($slider as $key => $value)
                            @if($key == 0)
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}" class="active"></li>
                            @else
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            @endif
                        @endforeach
                    </ol>

                    <div class="carousel-inner">
                        @foreach ($slider as $key => $value)
                            @if($key == 0)

                                <div class="carousel-item active">
                                    <img class="d-block w-100 img-fluid" src="{{ asset($value) }}">
                                </div>
                            @else

                                <div class="carousel-item">
                                    <img class="d-block w-100 img-fluid" src="{{ asset($value) }}">
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>

                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- banner section end ----->
@endif

<p class="text-justify">Ambitioni dedisse scripsisse iudicaretur. Cras mattis iudicium purus sit amet fermentum. Donec sed odio operae, eu vulputate felis rhoncus. Praeterea iter est quasdam res quas ex communi. At nos hinc posthac, sitientis piros Afros. Petierunt uti sibi concilium totius Galliae in diem certam indicere. Cras mattis iudicium purus sit amet fermentum.</p>

@endsection
