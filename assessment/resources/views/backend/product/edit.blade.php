@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Product') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('products.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" value="{{$data['id'] }}" />
                        <div class="form-group row">
                            <label for="product_name" class="col-md-4 col-form-label text-md-right">{{ __('Product Name') }}</label>

                            <div class="col-md-6">
                                <input id="product_name" type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ $data['product_name'] }}" required autocomplete="product_name" autofocus>

                                @error('product_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sku" class="col-md-4 col-form-label text-md-right">{{ __('SKU') }}</label>

                            <div class="col-md-6">
                                <input id="sku" type="text" class="form-control @error('sku') is-invalid @enderror" name="sku" value="{{ $data['sku'] }}" required autocomplete="sku">

                                @error('sku')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Quantity') }}</label>

                            <div class="col-md-6">
                                <input id="quantity" type="text" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ $data['quantity'] }}" required autocomplete="quantity" autofocus>

                                @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="product_image" class="col-md-4 col-form-label text-md-right">{{ __('Product Image') }}</label>

                            <div class="col-md-6">
                                <input id="product_image" type="file" class="form-control @error('product_image') is-invalid @enderror" name="product_image" value="" required autocomplete="product_image" autofocus>
                                @if (strpos($data['product_image'], '.jpg') !== false || strpos($data['product_image'], '.gif') !== false || strpos($data['product_image'], '.png') !== false || strpos($data['product_image'], '.jpeg') !== false || strpos($data['product_image'], '.svg') !== false)
                                    <img target="_blank" src="{{ asset('storage/images/'.$data['product_image']) }}" style="width:20%;  height:30px; border-radius: 50% "/>
                                @endif 
                                @error('product_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@if(session("success"))
    <p>{{session("Success")}}
@endif
@endsection
  


    