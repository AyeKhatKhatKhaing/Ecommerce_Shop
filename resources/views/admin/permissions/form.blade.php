<div class="row">
    <div class="col-md-8">
        <h2 class="fs-1">@if ($formMode === 'edit') {{ __('backend.common.edit') }} @else {{ __('backend.common.create') }} @endif {{ __('backend.permission.permissions') }}</h2>
    </div>
    <div class="col-md-4 text-end">
        <div class="form-group">
            <div class="form-group">
                <div class="float-left">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i>
                        {{ __('backend.common.save') }}</button>
                    <button type="button" class="btn btn-secondary cancel" onclick="window.location='{{ url('/admin/permissions')}}'"><i class="bi bi-x"
                            aria-hidden="true"></i> {{ __('backend.common.cancel') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
                            <div class="list-title mb-3">
                                {!! Form::label('name', __('backend.permission.name'), ['class' => 'control-label']) !!}
                            </div>
                            {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="form-group{{ $errors->has('label') ? ' has-error' : ''}}">
                            <div class="list-title mb-3">
                                {!! Form::label('label', __('backend.permission.label'), ['class' => 'control-label']) !!}
                            </div>
                            {!! Form::text('label', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('label', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
