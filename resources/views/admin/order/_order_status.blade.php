<div class="modal fade" id="orderStatusUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.order.status.update') }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <input type="hidden" name="order_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="padding-left: 130px;">Order Status Update Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        @php
                            $order_status = App\Enums\OrderStatusEnum::values();
                        @endphp
                        <div class="list-title mb-5">
                            <strong>Current Status: </strong><span class="badge badge-primary" id="orderStatusText"></span>
                        </div>
                        <select class="form-control" name="order_status" id="orderStatus"  placeholder="Please Select Country" data-placeholder="Please Select Status">
                            @if(isset($order_status))
                                @foreach ($order_status as $key =>  $order)
                                    <option value="{{ $key}}">{{ $order }}</option>
                                @endforeach
                            @endif
                        </select>
                        {!! $errors->first('order_status', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
