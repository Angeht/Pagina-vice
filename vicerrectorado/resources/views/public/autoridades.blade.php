<x-public-layout>

<div class="container mx-auto px-6 py-12">

    <h1 class="text-3xl font-bold mb-10 text-center">
        Autoridades
    </h1>

    <div class="grid md:grid-cols-3 gap-8">

        @foreach($autoridades as $a)
            <div class="bg-white shadow rounded-lg p-6 text-center">

                @if($a->foto)
                    <img src="{{ asset('storage/' . $a->foto) }}"
                         class="w-32 h-32 object-cover rounded-full mx-auto mb-4">
                @endif

                <h2 class="text-xl font-semibold">
                    {{ $a->nombre }}
                </h2>

                <p class="text-blue-600 font-medium">
                    {{ $a->cargo }}
                </p>

                <p class="text-gray-600 mt-3 text-sm">
                    {{ $a->descripcion }}
                </p>

            </div>
        @endforeach

    </div>

</div>

</x-public-layout>