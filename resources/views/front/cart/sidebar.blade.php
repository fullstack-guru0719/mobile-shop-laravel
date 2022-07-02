<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h5 class="mt-10 my-3" id="sell-more-devices">Sell more devices</h5>
            </div>
        </div>
        @if(isset($brands) && count($brands) > 0)
        @foreach($brands as $key => $val)
        <div class="row">
            <div class="col-md-12">
                <div @if (count($brands) !=$key + 1) class="border-bot1-gray padtb10" @else class="padtb10" @endif>
                    <i class="fa fa-chevron-right"></i>
                    <a href="{{ url('products/category/'.$val['name'].'') }}">
                        <span>{{ $val['name'] }}</span>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>