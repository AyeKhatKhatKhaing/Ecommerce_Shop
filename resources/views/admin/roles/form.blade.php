<div class="row">
    <div class="col-md-8">
        <h2 class="fs-1">@if ($formMode === 'edit') {{ __('backend.common.edit') }} @else {{ __('backend.common.create') }} @endif {{ __('backend.role.roles') }}</h2>
    </div>
    <div class="col-md-4 text-end">
        <div class="form-group">
            <div class="form-group">
                <div class="float-left">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i>
                        {{ __('backend.common.save') }}</button>
                    <button type="button" class="btn btn-secondary cancel" onclick="window.location='{{ url('/admin/roles')}}'"><i class="bi bi-x"
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
                                {!! Form::label('name',  __('backend.role.name'), ['class' => 'control-label']) !!}
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
                                {!! Form::label('label', __('backend.role.label'), ['class' => 'control-label']) !!}
                            </div>
                            {!! Form::text('label', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('label', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>

                <label class="mt-4">{{ __('backend.role.permissions') }}</label>
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-5 g-xl-9 mb-10 mt-4{{ $errors->has('label') ? ' has-error' : ''}}" style="overflow: scroll; height: 450px; border: 1px solid #eff2f5;">
                    @foreach($permissions as $key => $permission)

                        <div class="col-md-4">
                            <div class="card card-flush border">
                                <div class="card-header" style="border-bottom: 1px solid #eff2f5; min-height: 50px; background-color: #eff2f5;">
                                    <div class="card-title">
                                        <span>{{ $permission }}</span>
                                    </div>
                                </div>
                                <div class="card-body pt-5">
                                    @if($formMode === 'edit')
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $key }}" {{ in_array($permission, $role->permissions->pluck('label')->toArray() ) ? 'checked' : '' }}>
                                    @else
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $key }}">
                                    @endif
                                    <label class="control-label">{{ $key }}</label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
