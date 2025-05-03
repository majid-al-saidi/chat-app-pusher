<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Choose User to Chat With</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
            <ul>
                @foreach ($users as $user)
                    <li style="margin-bottom: 10px;">
                        <a href="{{ url('/chat/' . $user->id) }}" class="text-blue-500 hover:underline">
                            {{ $user->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>
