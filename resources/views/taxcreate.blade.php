@extends('template')
@section('header')
    <h3>{{request()->routeIs('taxonomy.edit') ? __('Update Attributes') : __('New Attributes')}}</h3>

@endsection
@section('wrap')
    <div class="table-responsive pt-5 pb-3">
        <div class="container">
            <form action="{{ request()->routeIs('taxonomy.edit') ? route('taxonomy.update', $tax->id) : route('taxonomy.store')}}" method="POST">
                @if(request()->routeIs('taxonomy.edit'))
                    @method('PUT')
                @endif
                
                @csrf
               <div class="row d-flex justify-content-center">
                    <div class="w-75">
                        
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{$error}}
                        </div>
                        @endforeach

                        <div class="mb-3 row">
                            <label for="inputName" class="col-4 col-form-label">{{ __('Taxonomy') }}</label>
                            <div class="col-8">
                                    <select class="form-select" name="name" id="name">
                                        <option {{request()->routeIs('taxonomy.edit') && $tax->name == 'color' ? 'selected' : false }} value="color">Color</option>
                                        <option {{request()->routeIs('taxonomy.edit')&& $tax->name == 'size' ? 'selected' : false }} value="size">Size</option>
                                        <option {{request()->routeIs('taxonomy.edit') && $tax->name == 'origin' ? 'selected' : false }} value="origin">Origin</option>
                                    </select>
                            </div>
                        </div>
                        <fieldset class="mb-3 row">
                            <label class="col-form-legend col-4">Tax Name</label>
                            <div class="col-8">
                                <input type="text" name="tax" value="{{ request()->routeIs('taxonomy.edit') ? $tax->tax : @old('tax')}}" id="tax" class="form-control">
                            </div>
                        </fieldset>
                        <div class="mb-3 row">
                            <div class="offset-sm-4 col-sm-8">
                                <button type="submit" class="btn btn-primary">{{request()->routeIs('taxonomy.edit') ? __('Update') : __('Submit')}}</button>
                            </div>
                        </div>
                    </div>
               </div>
            </form>
        </div>
    </div>
@endsection