<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $note->title }}</h2>
            <div class="flex space-x-2">
                <a href="{{ route('notes.edit', $note) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                <a href="{{ route('notes.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">Back</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="text-gray-500 text-sm mb-4">Created {{ $note->created_at->format('M d, Y g:i A') }} | Updated {{ $note->updated_at->diffForHumans() }}</p>
                    <div class="prose max-w-none">
                        {{ $note->content ? nl2br(e($note->content)) : 'No content.' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
