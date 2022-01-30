@if(count($product_ids) > 0)
<table class="table table-bordered sismoo-table">
    <thead>
      <tr>
        <td width="50%">
            <span>Product</span>
        </td>
        <td data-breakpoints="lg" width="20%">
            <span>Base Price</span>
        </td>
        <td data-breakpoints="lg" width="20%">
            <span>Discount</span>
        </td>
        <td data-breakpoints="lg" width="10%">
            <span>Discount Type</span>
        </td>
      </tr>
    </thead>
    <tbody>
        @foreach ($product_ids as $key => $id)
            @php
              $product = \App\Models\Product\Product::findOrFail($id);
              //$flash_deal_product = \App\Models\FlashDealProduct::where('flash_deal_id', $flash_deal_id)->where('product_id', $product->id)->first();
              $flash_deal_product = DB::table('flashdeal_product')
                        ->where('flashdeal_id', '=', $flash_deal_id)
                        ->where('product_id', '=', $product->id)
                        ->first();
            @endphp
            <tr>
                <td>
                    <div class="from-group row">
                        <div class="col-auto">
                          <img class="" width="70px" src="{{ asset('uploads/productphoto/'.$product->image)}}">
                        </div>
                        <div class="col">
                          <span>{{  $product->title }}</span>
                        </div>
                      </div>
                </td>
                <td>
                    <span>{{ $product->unit_price }}</span>
                </td>
                <td>
                    <input type="number" lang="en" name="discount_{{ $id }}" value="{{ $product->discount_rate }}" min="0" step="1" class="form-control" required>
                </td>
                <td>
                    <select class="form-control sismoo-selectpicker" name="discount_type_{{ $id }}">
                        <option value="Flat" <?php if($product->discount_type == 'Flat') echo "selected";?> >Flat</option>
                        <option value="Percent" <?php if($product->discount_type == 'Percent') echo "selected";?> >Percent</option>
                    </select>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif
