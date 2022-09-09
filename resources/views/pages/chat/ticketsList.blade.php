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
                  <td class=" font-weight-bold">
                    {{ $item->title }}
                  </td>
                  <td>{{ $item->created_at }}</td>
                  <td class="text-primary">{{ $item->ticket_status->name_ru }}</td>
                  <td>
                    {{ $item->messages->count() }}
                  </td>
                  <td class="table-action-td">
                    @if ( $item->status_id == 1 )
                    {{-- UPDATE BUTTON --}}
                    <form class="table-action-form" method="GET" action="{{ route('update-ticket', ['ticket_uid' => $item->ticket_uid]) }}">
                      @csrf
                      <button class="table-action-button" type="submit">
                        <svg style="color: black;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                        </svg>
                      </button>
                    </form>
                    {{-- UPDATE BUTTON END --}}
                    @endif
                    @if ( in_array($item->status_id, [1,2]) )
                    {{-- DELETE BUTTON --}}
                    <form class="table-action-form ml-4" method="POST" action="{{ route('delete-ticket', ['ticket_uid' => $item->ticket_uid]) }}">
                      @csrf
                      <button class="table-action-button" type="submit">
                        <svg style="color: black;"  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                          <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                        </svg>
                      </button>
                    </form>

                    </a>
                    {{-- DELETE BUTTON END --}}
                    @endif
                    @if ( $item->status_id == 3 )
                    {{-- CHAT BUTTON --}}
                    <form class="table-action-form" method="GET" action="{{ route('view-ticket', ['ticket_uid' => $item->ticket_uid]) }}">
                      @csrf
                      <button class="table-action-button" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-square-text" viewBox="0 0 16 16">
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