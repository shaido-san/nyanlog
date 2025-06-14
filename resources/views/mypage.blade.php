<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('マイページ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="text-lg mb-4">こんにちは！</p>

                    <ul class="list-disc pl-6 space-y-2">
                        <li><a href="{{ route('posts.index') }}" class="text-blue-600 hover:underline">自分の投稿一覧を見る</a></li>
                        <li><a href="{{ route('posts.create') }}" class="text-blue-600 hover:underline">新しい投稿を作成する</a></li>
                        {{-- 将来的に共有機能が入ったらここにリンクを追加 --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
