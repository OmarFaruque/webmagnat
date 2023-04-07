@extends('template')

@section('header')
    <h3>{{request()->routeIs('product.edit') ? __('Update Product') : __('New Product')}}</h3>

@endsection

@section('wrap')
    <div class="table-responsive">
        <div class="container">
            <a class="mt-1 btn btn-primary" href="{{ route('product.index') }}">{{ __('Back to Lists') }}</a>
            <form method="POST" action="{{ request()->routeIs('product.edit') ? route('product.update', $product->id) : route('product.store') }}" enctype="multipart/form-data">
               <div class="row d-flex justify-content-center pt-5 pb-3">
                    <div class="w-75">
                        @if(request()->routeIs('product.edit'))
                            @method('PUT')
                        @endif
                        @csrf
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{$error}}
                        </div>
                        @endforeach

                        <div class="mb-3 row">
                            <label for="inputName" class="col-4 col-form-label">{{__('Product Name')}}</label>
                            <div class="col-8">
                                <input type="text" class="form-control" value="{{ request()->routeIs('product.edit') ? $product->name : '' }}" name="name" id="name" placeholder="{{__('Product Name')}}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputName" class="col-4 col-form-label">{{__('Color')}}</label>
                            <div class="col-8">
                                <select name="color" class="form-control" id="color">
                                    <option value="">{{ __('Select color...') }}</option>
                                    @foreach ($colors as $color)
                                        <option {{ request()->routeIs('product.edit') && $product->color == $color->tax ? 'selected':'' }} value="{{$color->tax}}">{{$color->tax}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inputName" class="col-4 col-form-label">{{__('Size')}}</label>
                            <div class="col-8">
                                <select name="size" class="form-control" id="size">
                                    <option value="">{{ __('Select size...') }}</option>
                                    @foreach ($sizes as $size)
                                        <option {{ request()->routeIs('product.edit') && $product->size == $size->tax ? 'selected':'' }} value="{{$size->tax}}">{{$size->tax}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inputName" class="col-4 col-form-label">{{__('Origin')}}</label>
                            <div class="col-8">
                                <select name="origin" class="form-control" id="origin">
                                    <option value="">{{ __('Select Origin...') }}</option>
                                    @foreach ($origins as $origin)
                                        <option {{ request()->routeIs('product.edit') && $product->origin == $origin->tax ? 'selected':'' }} value="{{$origin->tax}}">{{$origin->tax}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inputName" class="col-4 col-form-label">{{__('Price')}}</label>
                            <div class="col-8">
                                <input type="number" value="{{ request()->routeIs('product.edit') ? $product->price : '' }}" name="price" id="price" placeholder="{{__('Price...')}}" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inputName" class="col-4 col-form-label">{{ __('Price with VAT') }}</label>
                            <div class="col-8">
                                <input type="number" value="{{ request()->routeIs('product.edit') ? $product->price_with_vat : '' }}" name="price_with_vat" id="price_with_vat" placeholder="{{__('Price with vat...')}}" class="form-control">
                            </div>
                        </div>


                        <div class="mb-3 row">
                            <label for="inputName" class="col-4 col-form-label">{{ __('Product Image') }}</label>
                            <div class="col-8">
                                @if(request()->routeIs('product.edit'))
                                    <div class="w-25 mb-2">
                                        <img src="{{asset('uploads/'.$product->photo)}}" alt="{{$product->name}}" class="img-fluid w-100">
                                    </div>
                                @endif
                                <input class="form-control" type="file" id="photo" name="photo">
                            </div>
                        </div>
                        
                        <div class="mb-3 row">
                            <div class="offset-sm-4 col-sm-8">

                                <div>
                                    <button type="submit" class="btn btn-primary">{{request()->routeIs('product.edit') ? __('Update') : __('Submit')}}</button>
                                </div>
                                
                            </div>
                        </div>
                    </div>
               </div>
            </form>
        </div>
    </div>
@endsection