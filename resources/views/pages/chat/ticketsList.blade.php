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




                  <td style="color: #000000;">{{ $item->created_at }}</td>
                  <td class="text-primary">{{ $item->ticket_status->name_ru }}</td>
                  <td>
                    {{ $item->messages->count() }}
                  </td>
                  <td  style="display: flex; justify-content: center;" class="table-action-td">
                    @if ( $item->status_id == 1 )
                    {{-- UPDATE BUTTON --}}
                    <form class="table-action-form" method="GET" action="{{ route('update-ticket', ['ticket_uid' => $item->ticket_uid]) }}">
                      @csrf
                      <button class="table-action-button" type="submit">
                        <img style="width: 32px;" src="/public/images/edit.svg" alt="">
                      </button>
                    </form>
                    {{-- UPDATE BUTTON END --}}
                    @endif
                    @if ( in_array($item->status_id, [1,2]) )
                    {{-- DELETE BUTTON --}}
                    <form class="table-action-form" method="POST" action="{{ route('delete-ticket', ['ticket_uid' => $item->ticket_uid]) }}">
                      @csrf
                      <button class="table-action-button" type="submit">
                        <img style="width: 24px;" src="/public/images/trash.svg" alt="">
                      </button>
                    </form>

                    </a>
                    {{-- DELETE BUTTON END --}}
                    @endif
                    @if ( $item->status_id == 3 )
                    {{-- CHAT BUTTON --}}
                    <form class="table-action-form" method="GET" action="#">
                      @csrf
                      <button class="table-action-button" type="submit">
                        <img style="width: 24px;" src="/public/images/trash.svg" alt="">
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
          <div class="panel-footer" style="margin-top: 25px;">
            <div class="row">
              <div class="col col-sm-6 col-xs-6">
                <p style="color: #000000; font-size: 20px;">страница 1 из 1</p>

              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    </div>
  </section>












  @stop