@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 col-lg-4 d-md-block d-lg-block d-none d-xs-none d-sm-none">
           <x-menuLateralLg />
        </div>
        
        <div class="col-lg-8 col-md-8 col-sm-12">
            <div class="card">
                <div class="card-header color-theme-app">Import Transactions</div>
                <div class="card-body">
                    <form action="{{route('transaction.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="custom-file mb-3">
                            <input required class="custom-file-input" type="file" name="csvFile" id="validatedCustomFile">
                            <!-- <input type="file" class="custom-file-input" id="validatedCustomFile" name="csvFile" required> -->
                            <label class="custom-file-label" for="validatedCustomFile">Choose a csv file...</label>
                            <div class="invalid-feedback">error to process file</div>
                            
                            
                        </div>
                        <button type="submit" class="btn btn-primary">Send</button>
                       
                        <!-- <button type="submit">Enviar</button> -->
                    </form>
                    @if (isset($result))
                        @if($result === 'yes')
                            <x-AlertSucess/>
                        @else
                            <x-AlertDanger/>
                        @endif
                    @endisset
                    <!-- <x-AlertDanger/> -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

