@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table text-regular">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Area</th>
                                <th>Price</th>
                                <th>Hours</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $date)
                                <tr>
                                    <td>{{ $date->id }}</td>
                                    <td>{{ $date->area }}</td>
                                    <td>
                                        {{ currency_format($date->price) . ' ' . $date->currency }}
                                    </td>
                                    <td>
                                        {{ $date->delivery_start->format('d-m-Y H:i') . ' - ' . $date->delivery_end->format('d-m-Y H:i') }}
                                    </td>
                                    <td>{{ $date->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $date->updated_at->format('d-m-Y') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
