@php use Illuminate\Database\Eloquent\Builder; @endphp
<div class="grid grid-cols-8 gap-5 bg">

    @foreach($cardsTitle as $index=>$title)


        <div class="lg:col-span-2 col-span-8">
            <div class="card">
                <div class="card-body p-2">
                    <div class="flex justify-between">
                        <!-- Column -->
                        <div class="col d-flex align-items-center">
                            <div>
                                <h3 class="text-2xl">
                                    {{ $cardsValue[$index] }}
                                </h3>
                                <p class="mb-0">
                                    {{ $title }}
                                </p>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col d-flex align-items-center justify-content-end" style="color: #0079d6">
{{--                            <div data-label="20%" class="css-bar mb-0 css-bar-primary css-bar-20">--}}
                                <i class="{{ $cardsIcon[$index] }}" style="font-size: 35px; border: none"></i>
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach




</div>
