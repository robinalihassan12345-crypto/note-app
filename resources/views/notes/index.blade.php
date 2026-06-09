<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Notes</h2>
            <a href="{{ route('notes.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">+ New Note</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @forelse ($notes as $note)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-between items-start">
                            <div>
                                <a href="{{ route('notes.show', $note) }}" class="text-lg font-semibold text-blue-600 hover:text-blue-800">
                                    {{ $note->title }}
                                </a>
                                <p class="text-gray-500 text-sm mt-1">
                                    {{ Str::limit($note->content, 150) }}
                                </p>
                                <p class="text-gray-400 text-xs mt-2">
                                    Created {{ $note->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('notes.edit', $note) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                <form action="{{ route('notes.destroy', $note) }}" method="POST" onsubmit="return confirm('Delete this note?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 text-center">
                        <p class="text-gray-500">No notes yet.</p>
                        <a href="{{ route('notes.create') }}" class="text-blue-500 hover:text-blue-700 mt-2 inline-block">Create your first note</a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
