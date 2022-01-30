<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use App\Models\Product\Attribute;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class AttributevalueController extends Controller
{
    public function index($id)
    {
        $attribute = Attribute::findOrFail($id);
        return view('backend.admin.product.attribute.attribute_value.form',compact('attribute'));
    }

    public function create($id)
    {
        $attributevalue = Attribute::findOrFail($id);
        return view('backend.admin.product.attribute.attribute_value.form',compact('attributevalue'));
    }

    public function store(Request $request,$id)
    {
        $attribute = Attribute::findOrFail($id);


        $attribute->attributevalues()->create([
            'value' => $request->value,

        ]);
        notify()->success("Attribute Value Successfully created","Added");
        return redirect()->route('admin.attributes.values',$id);
    }

    public function edit($id,$attrId)
    {
        $attribute = Attribute::findOrFail($id);
        $attrvalue = $attribute->attributevalues()->findOrFail($attrId);
        return view('backend.admin.product.attribute.attribute_value.form',compact('attrvalue','attribute'));
    }

    public function update(Request $request,$id,$attrId)
    {
        $attribute = Attribute::findOrFail($id);

        $attribute->attributevalues()->findOrFail($attrId)->update([
            'value' => $request->value,
        ]);

        notify()->success('Attribute Values Item Updated','Update');
        return redirect()->route('admin.attributes.values',$id);
    }

    public function destroy($id,$attrId)
    {
        $attribute = Attribute::findOrFail($id);

        Attribute::findOrFail($id)
                 ->attributevalues()
                 ->findOrFail($attrId)
                 ->delete();

        notify()->success('Attribute Values Delete Successfully');
        return back();
    }


}
