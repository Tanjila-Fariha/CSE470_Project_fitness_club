@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Notifications') }}
                    </h2>
                    
                    @php
                        $unreadCount = \App\Models\Notification::where('user_id', auth()->id())
                            ->where('is_read', false)
                            ->count();
                    @endphp
                    
                    @if($unreadCount > 0)
                        <form action="{{ route('notifications.markAllAsRead') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-blue-500 hover:text-blue-700 text-sm">
                                Mark all as read
                            </button>
                        </form>
                    @endif
                </div>

                @if($notifications->isEmpty())
                    <p class="text-gray-600">No notifications</p>
                @else
                    <div class="space-y-4">
                        @foreach($notifications as $notification)
                            <div class="border-b border-gray-200 pb-4 {{ $notification->is_read ? 'opacity-50' : '' }}">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-gray-800">{{ $notification->message }}</p>
                                        <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                                    </div>
                                    @if(!$notification->is_read)
                                        <form action="{{ route('notifications.markAsRead', $notification) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-blue-500 hover:text-blue-700 text-sm">
                                                Mark as read
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4">
                        {{ $notifications->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 