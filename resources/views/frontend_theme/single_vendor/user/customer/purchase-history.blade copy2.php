

@php
    $orders = \App\Models\Order\Order::where('user_id', Auth::user()->id)->orderBy('code', 'desc')->paginate(2);
@endphp


<div class="col-lg-9">
  <div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{ translate('Purchase History') }}</h5>
    </div>

    <div class="card-body">
      <table class="table sismoo-table mb-0">
          <thead>
              <tr>
                  <th>{{ translate('Code')}}</th>
                  <th data-breakpoints="md">{{ translate('Date')}}</th>
                  <th>{{ translate('Amount')}}</th>
                  <th data-breakpoints="md">{{ translate('Delivery Status')}}</th>
                  <th data-breakpoints="md">{{ translate('Payment Status')}}</th>
                  <th class="text-right">{{ translate('Options')}}</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($orders as $key => $order)
                  @if (count($order->orderDetails) > 0)
                      <tr>
                          <td>
                              <a href="#{{ $order->code }}" onclick="show_purchase_history_details({{ $order->id }})">{{ $order->code }}</a>
                          </td>
                          <td>{{ date('d-m-Y', $order->date) }}</td>
                          <td>
                              {{ $order->grand_total }}
                          </td>
                          <td>
                              {{ translate(ucfirst(str_replace('_', ' ', $order->delivery_status))) }}
                              @if($order->delivery_viewed == 0)
                                  <span class="ml-2" style="color:green"><strong>*</strong></span>
                              @endif
                          </td>
                          <td>
                              @if ($order->payment_status == 'paid')
                                  <span class="badge badge-inline badge-success">{{translate('Paid')}}</span>
                              @else
                                  <span class="badge badge-inline badge-danger">{{translate('Unpaid')}}</span>
                              @endif
                              @if($order->payment_status_viewed == 0)
                                  <span class="ml-2" style="color:green"><strong>*</strong></span>
                              @endif
                          </td>
                          <td class="text-right">
                              @if ($order->orderDetails->first()->delivery_status == 'pending' && $order->payment_status == 'unpaid')
                                  <a href="javascript:void(0)" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="#" title="{{ translate('Cancel') }}">
                                    <i class="fa fa-trash"></i>
                                </a>
                              @endif
                              <a href="javascript:void(0)" class="btn btn-soft-info btn-icon btn-circle btn-sm" onclick="show_purchase_history_details({{ $order->id }})" title="{{ translate('Order Details') }}">
                                  <i class="fa fa-eye"></i>
                              </a>
                              <a class="btn btn-soft-warning btn-icon btn-circle btn-sm" href="#" title="{{ translate('Download Invoice') }}">
                                  <i class="fa fa-download"></i>
                              </a>
                          </td>
                      </tr>
                  @endif
              @endforeach
          </tbody>
      </table>
      <div class="sismoo-pagination">
        {{ $orders->links() }}
      </div>
    </div>
  </div>
</div>

@endsection

@section('modal')
<div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div id="order-details-modal-body">

            </div>
        </div>
    </div>
</div>
@endsection