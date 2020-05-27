@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="{{ $user->profile->profileImage() }}" alt="" class="rounded-circle w-100"/>
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex pb-4">
                    <h4>
                        {{ $user->username }}
                    </h4>
                </div>
                @can('follow', $user->profile)
                    <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                @endcan
                @can('update', $user->profile)
                    <a href="/post/create">Add new post</a>
                @endcan
            </div>

            @can('update', $user->profile)
                <a href="/profile/{{ $user->id }}/edit">Edit profile</a>
            @endcan

            <div class="d-flex">
                <div class="pr-5">
                    <strong>{{ $postCount }}</strong>posts
                </div>
                <div class="pr-5">
                    <strong>{{ $followersCount }}</strong>followers
                </div>
                <div class="pr-5">
                    <strong>{{ $followingCount }}</strong>following
                </div>
            </div>
            <div class="pt-4 font-weight-bold">
                <h1>
                    {{ $user->profile->title ?? ''}}
                </h1>
            </div>
            <div>
                {!! $user->profile->description ?? '' !!}
            </div>
            <div>
                <a href="{{ $user->profile->url ?? ''}}">{{ $user->profile->url ?? ''}}</a>
            </div>
        </div>
    </div>
    <div class="row pt-5">
        @foreach($user->posts as $post)
            <div class="col-4 pt-4">
                <a href="/post/{{ $post->id }}" ><img src="/storage/{{ $post->image }}" class="w-100"/></a>
            </div>
        @endforeach
    </div>
</div>
@endsection
