@php
    $orders = \App\Models\Order\Order::where('user_id', Auth::user()->id)->orderBy('code', 'desc')->paginate(12);
@endphp

<div>
    <div class="wishlist-content">
        <h3 class="account-sub-title d-none d-md-block"><i
                class="sicon-social-dropbox align-middle mr-3"></i>{{ translate('Purchase History') }}</h3>
        <div class="wishlist-table-container text-center">
            <table class="table table-wishlist text-left">
                <thead>
                    <tr>
                        <th class="wishlist-id">Code</th>
                        <th class="wishlist-date">Date</th>
                        <th class="wishlist-status">Amount</th>
                        <th class="wishlist-price">Delivery Status</th>
                        <th class="wishlist-price">Payment Status</th>
                        <th class="wishlist-action">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key => $order)
                    @if (count($order->orderDetails) > 0)
                        <tr class="product-row">
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
                            <td class="">
                                @if ($order->orderDetails->first()->delivery_status == 'pending' && $order->payment_status == 'unpaid')
                                    <a href="javascript:void(0)" class="btn btn-circle btn-soft-danger  mt-1 mt-md-0" data-href="#" title="{{ translate('Cancel') }}">
                                      <i class="fa fa-trash"></i>
                                  </a>
                                @endif
                                <a href="javascript:void(0)" class="btn btn-circle btn-soft-info  mt-1 mt-md-0 btn-sm" onclick="show_purchase_history_details({{ $order->id }})" title="{{ translate('Order Details') }}">
                                    <i class="fa fa-eye"></i>
                                </a>
                                {{-- <a class="btn btn-circle btn-soft-warning btn-xs " href="#" title="{{ translate('Download Invoice') }}">
                                    <i class="fa fa-download"></i>
                                </a> --}}
                                
                            </td>
                        </tr>
                    @endif 
                    @endforeach
                </tbody>
            </table>

            <div>
                {{ $orders->links() }}
            </div>
            <hr class="mt-0 mb-3 pb-2" />

            <a href="category.html" class="btn btn-dark">Go Shop</a>
        </div>
    </div>
</div>