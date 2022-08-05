@extends('layouts.default')

@section('content')
<body>
    <div class="main-banner">
        <section class="vh-100" style="background-color: white;">
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">{{ Lang::get('# of request')}}</th>
                        <th scope="col">{{ Lang::get('Topic')}}</th>
                        <th scope="col">{{ Lang::get('Date')}}</th>
                        <th scope="col">{{ Lang::get('Status')}}</th>
                        <th scope="col">{{ Lang::get('Chat')}}</th>
                        <th scope="col">{{ Lang::get('Action')}}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($my_tickets as $item)
                      <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->ticket_status->name_ru }}</td>
                        <td></td>
                        <td></td>
                      </tr>
                      @endforeach
                      
                    </tbody>
                </table>
        </section>
    </div>
    
</body>
@stop