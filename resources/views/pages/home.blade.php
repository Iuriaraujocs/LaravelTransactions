@extends('layouts.mainAdmin')

@section('title','iuri title')
@section('content')
    <h1>teste {{$teste}}</h1>

    <form action="{{route('transaction.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="csvFile" id="">
        <button type="submit">Enviar</button>
    </form>
    @if (isset($record))
        @foreach ($record as $row)
            <h1>{{$row->client}}</h1>
        @endforeach
    @endif

@endsection