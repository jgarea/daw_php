@extends('plantillas.plantilla1')
@section('titulo')
    {{$titulo}}
@endsection
@section('encabezado')
    {{$encabezado}}
@endsection
@section('contenido')
    <table>
        <thead>
            <tr>
                <th>Nombre completo</th>
                <th>Posición</th>
                <th>Dorsal</th>
            </tr>
        </thead>
        <tbody>
        @foreach($jugadores as $item)
            <tr>
                <th>{{$item->apellidos.", ".$item->nombre}}</th>
                <td>{{$item->posicion}}</td>
                @if(isset($item->dorsal))
                    <td>{{$item->dorsal}}</td>
                @else
                    <td>Sin Asignar</td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection