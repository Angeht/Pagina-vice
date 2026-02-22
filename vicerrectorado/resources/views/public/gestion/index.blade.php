<x-public-layout>

<div class="container mx-auto px-6 py-12">

    <h1 class="text-3xl font-bold mb-10 text-center">
        Gestión Académica
    </h1>

    @foreach($documentos as $tipo => $items)

        <h2 class="text-2xl font-semibold mt-10 mb-6 capitalize">
            {{ str_replace('_', ' ', $tipo) }}
        </h2>

        <div class="space-y-4">
            @foreach($items as $doc)
                <div class="bg-white shadow rounded p-4 flex justify-between items-center">

                    <div>
                        <h3 class="font-semibold">
                            {{ $doc->titulo }}
                        </h3>

                        @if($doc->fecha_publicacion)
                            <p class="text-sm text-gray-500">
                                {{ $doc->fecha_publicacion }}
                            </p>
                        @endif
                    </div>

                    @if($doc->archivo)
                        <a href="{{ asset('storage/' . $doc->archivo) }}"
                           target="_blank"
                           class="text-blue-600 font-semibold">
                            Descargar PDF
                        </a>
                    @endif

                </div>
            @endforeach
        </div>

    @endforeach

</div>

</x-public-layout>