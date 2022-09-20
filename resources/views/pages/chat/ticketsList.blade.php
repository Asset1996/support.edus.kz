@extends('layouts.default')
@section('title', Lang::get('My appeals'))

@section('content')
<body>
  <section class="table">
    <div class="container">
      <div class="col-md-offset-1 col-lg-12">
        <div class="panel">
          <div class="panel-heading">
            <div class="col">
              <h4 class="title">{{ Lang::get('My appeals') }}</h4>
            </div>
          </div>
          <div class="panel-body table-responsive">
            <table class="table">
              <thead>
                <tr class="firstTableTr">
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
                <tr class="tableTr">
                  <td><a href="{{ route('view-ticket', ['ticket_uid' => $item->ticket_uid]) }}">{{ $item->ticket_uid }}</a></td>
                  <td style="max-width: 346px; word-wrap: break-word;" class="font-weight-bold">
                    {{ $item->title }}
                  </td>
                  <td>{{ $item->created_at }}</td>
                  <td class="text-primary">{{ $item->ticket_status['name_'.Lang::locale()] }}</td>
                  <td>
                    {{ $item->messages->count() }}
                  </td>
                  <td class="table-action-td">
                    @if ( $item->status_id == 1 )
                    {{-- UPDATE BUTTON --}}
                    <form class="table-action-form" method="GET" action="{{ route('update-ticket', ['ticket_uid' => $item->ticket_uid]) }}">
                      @csrf
                      <button class="table-action-button" type="submit">
                          <img style="width: 32px;" src="{{ asset('images/edit.svg') }}" alt="">
                      </button>
                    </form>
                    {{-- UPDATE BUTTON END --}}
                    @endif
                    @if ( in_array($item->status_id, [1,2]) )
                    {{-- DELETE BUTTON --}}
                    <form class="table-action-form ml-4" method="POST" action="{{ route('delete-ticket', ['ticket_uid' => $item->ticket_uid]) }}">
                      @csrf
                      <button class="table-action-button" type="submit">
                          <img style="width: 24px;" src="{{ asset('images/trash.svg') }}" alt="">
                      </button>
                    </form>
                    {{-- DELETE BUTTON END --}}
                    @endif
                    @if ( $item->status_id == 3 )
                    {{-- CHAT BUTTON --}}
                    <form class="table-action-form ml-4" method="GET" action="{{ route('view-ticket', ['ticket_uid' => $item->ticket_uid]) }}">
                      @csrf
                      <button class="table-action-button" type="submit">
                        <svg style="color: black;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-chat-square-text" viewBox="0 0 16 16">
                          <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                          <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                        </svg>
                      </button>
                    </form>
                    {{-- CHAT BUTTON END --}}
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="panel-footer">
            <div class="row">
              <div class="col col-sm-6 col-xs-6">страница 1 из 1</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
</body>
@stop
