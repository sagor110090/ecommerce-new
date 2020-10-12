<!-- brand area start -->
<div class="brand-area pt-28 pb-30 pt-md-14 pt-sm-14">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title mb-30">
                    <div class="title-icon">
                        <i class="fa fa-crop"></i>
                    </div>
                    <h3>Popular Brand</h3>
                </div> <!-- section title end -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="brand-active slick-padding slick-arrow-style">
                    @foreach (Helper::getAll('brands') as $item)
                        <div class="brand-item text-center">
                        <a href="#"><img src="{{Storage::url($item->image)}}" alt=""></a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- brand area end -->