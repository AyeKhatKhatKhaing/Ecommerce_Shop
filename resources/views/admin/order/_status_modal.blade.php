@php
   $order_status = App\Enums\OrderStatusEnum::values();
@endphp
<div class="modal fade text-left" id="sendStatusMail{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Send Order Status E-Mail</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>                    
            </div>
            <div class="modal-body py-0">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    {!! Form::model($item, [
                                        'method' => 'get',
                                        'url' => ['/admin/order/send-status-mail', $item->id],
                                        'class' => 'form-horizontal'
                                    ]) !!}
                                        <div class="col-md-12">
                                            {!! Form::label('order_status', 'Order Status', ['class' => 'control-label mb-3 required']) !!}
                                            <select class="form-select mb-3" name="order_status" data-control="select2" data-placeholder="Select Status" data-hide-search="true" required>
                                                <option></option>
                                                @foreach($order_status as $key => $status)
                                                    <option value="{{ $key }}">{{ $status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-auto mt-4">
                                            <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-save"></i>
                                                Send
                                            </button>
                                            <button class="btn btn-secondary btn-sm cancel" type="button" data-bs-dismiss="modal" aria-label="Close">
                                                <i class="fa fa-times" aria-hidden="true"></i> Cancel
                                            </button>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>