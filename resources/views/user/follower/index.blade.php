@extends('layout.default')

@section('title')
    <title>{{ $user->username }} {{ __('user.followers') }} - {{ config('other.title') }}</title>
@endsection

@section('breadcrumbs')
    <li class="breadcrumbV2">
        <a href="{{ route('users.show', ['username' => $user->username]) }}" class="breadcrumb__link">
            {{ $user->username }}
        </a>
    </li>
    <li class="breadcrumb--active">
        {{ __('user.followers') }}
    </li>
@endsection

@section('nav-tabs')
    @include('user.buttons.user')
@endsection

@section('content')
    <div class="container-fluid">
        @if (!auth()->user()->isAllowed($user,'follower','show_follower'))
            <div class="container pl-0 text-center">
                <div class="jumbotron shadowed">
                    <div class="container">
                        <h1 class="mt-5 text-center">
                            <i class="{{ config('other.font-awesome') }} fa-times text-danger"></i>{{ __('user.private-profile') }}
                        </h1>
                        <div class="separator"></div>
                        <p class="text-center">{{ __('user.not-authorized') }}</p>
                    </div>
                </div>
            </div>
        @else
            <div class="block">
                <div class="forum-categories">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>{{ __('user.avatar') }}</th>
                            <th>{{ __('user.user') }}</th>
                            <th>{{ __('common.created_at') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($followers as $follower)
                            <tr>
                                @if ($follower->image != null)
                                    <td><a href="{{ route('users.show', ['username' => $follower->username]) }}">
                                            <img src="{{ url('files/img/' . $follower->image) }}" alt="avatar"
                                                 data-toggle="tooltip"
                                                 title="{{ $follower->username }}" height="50px"
                                                 data-original-title="{{ $follower->username }}">
                                        </a></td>
                                @else
                                    <td><a href="{{ route('users.show', ['username' => $follower->username]) }}">
                                            <img src="{{ url('img/profile.png') }}" alt="avatar" data-toggle="tooltip"
                                                 title="{{ $follower->username }}" height="50px"
                                                 data-original-title="{{ $follower->username }}">
                                        </a></td>
                                @endif
                                <td><a href="{{ route('users.show', ['username' => $follower->username]) }}">
                                            <span class="badge-user text-bold"
                                                  style="color:{{ $follower->group->color }};">{{ $follower->username }}</span>
                                    </a></td>
                                <td>{{ $follower->follow->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center col-md-12">
                    {{ $followers->links() }}
                </div>
            </div>
        @endif
    </div>
@endsection
