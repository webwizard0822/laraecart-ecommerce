    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#review" data-toggle="tab">{!! trans('ecommerce::review.tab.name') !!}</a></li>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-primary btn-sm" data-action='UPDATE' data-form='#ecommerce-review-edit'  data-load-to='#ecommerce-review-entry' data-datatable='#ecommerce-review-list'><i class="fa fa-floppy-o"></i> {{ trans('app.save') }}</button>
                <button type="button" class="btn btn-default btn-sm" data-action='CANCEL' data-load-to='#ecommerce-review-entry' data-href='{{guard_url('ecommerce/review')}}/{{$review->getRouteKey()}}'><i class="fa fa-times-circle"></i> {{ trans('app.cancel') }}</button>

            </div>
        </ul>
        {!!Form::vertical_open()
        ->id('ecommerce-review-edit')
        ->method('PUT')
        ->enctype('multipart/form-data')
        ->action(guard_url('ecommerce/review/'. $review->getRouteKey()))!!}
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="review">
                <div class="tab-pan-title">  {{ trans('app.edit') }}  {!! trans('ecommerce::review.name') !!} [{!!$review->name!!}] </div>
                @include('ecommerce::admin.review.partial.entry', ['mode' => 'edit'])
            </div>
        </div>
        {!!Form::close()!!}
    </div>