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
               
               <div class="container mt-4">
                <p>
                    <a class="btn btn-primary" data-toggle="collapse" href="#collapseTransactionShow" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Get Transactions
                     </a>
                </p>
                </div>
            <div class="collapse" id="collapseTransactionShow">
                <div class="card card-body tableResponsiveTransaction">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Client</th>
                                <th scope="col">Deal</th>
                                <th scope="col">Hour</th>
                                <th scope="col">Accepted</th>
                                <th scope="col">Refused</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if (isset($record))
                        @foreach ($record as $row)
                        
                        <tr>
                                <th scope="row">{{$loop->count}}</th>
                                <td>{{$row->client}}</td>
                                <td>{{$row->deal}}</td>
                                <td>{{date('d/m/y', strtotime($row->hour))}}</td>
                                <td>{{$row->accepted}}</td>
                                <td>{{$row->refused}}</td>
                            </tr>
                          
                          @endforeach
                    @endif
                            <!-- <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr> -->
                        </tbody>
                    </table>
    </div>
</div>
            </div>
        </div>
    </div>
</div>
@endsection