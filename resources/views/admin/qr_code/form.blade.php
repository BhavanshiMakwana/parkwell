{!! Form::hidden('redirects_to', URL::previous()) !!}

@if(isset($qr_code) && !empty($qr_code['code']))
    <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
        <label class="col-sm-2 control-label" for="code">Code <span class="text-red">*</span></label>
        <div class="col-sm-5">
            {!! Form::text('code', null, ['class' => 'form-control','readonly']) !!}
            @if ($errors->has('code'))
                <span class="help-block">
                    <strong>{{ $errors->first('code') }}</strong>
                </span>
            @endif
        </div>
    </div>
@else
    <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
        <label class="col-sm-2 control-label" for="quantity">Quantity For QR Code <span class="text-red">*</span></label>
        <div class="col-sm-5">
            {!! Form::number('quantity', null, ['class' => 'form-control','min'=>1,'step'=>1]) !!}
            @if ($errors->has('quantity'))
                <span class="help-block">
                    <strong>{{ $errors->first('quantity') }}</strong>
                </span>
            @endif
        </div>
    </div>
@endif

<div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
    <label class="col-sm-2 control-label" for="role">Type <span class="text-red">*</span></label>
    <div class="col-sm-5">
        @foreach (\App\Models\QRCodeRecord::$type as $key1 => $value1)
            <label>
                {!! Form::radio('type', $key1, null, ['class' => 'flat-red']) !!} <span style="margin-right: 10px">{{ $value1 }}</span>
            </label>
        @endforeach
        <br>
        @if ($errors->has('type'))
            <span class="help-block">
                <strong>{{ $errors->first('type') }}</strong>
            </span>
        @endif
    </div>
</div>
