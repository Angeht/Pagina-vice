<div class="container mx-auto">

    <h1 class="text-2xl font-bold mb-6">
        Logs de Auditoría
    </h1>

    <div class="bg-white shadow rounded p-6">

        {{-- Filtros --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            
            <div>
                <label class="block text-sm font-medium mb-1">Buscar</label>
                <input type="text" 
                       wire:model.live.debounce.500ms="busqueda"
                       placeholder="Buscar en logs..."
                       class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Modelo</label>
                <select wire:model.live="filtroModelo" class="w-full border rounded p-2">
                    <option value="">Todos los modelos</option>
                    @foreach($modelos as $modelo)
                        <option value="{{ $modelo['value'] }}">{{ $modelo['label'] }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Evento</label>
                <select wire:model.live="filtroEvento" class="w-full border rounded p-2">
                    <option value="">Todos los eventos</option>
                    <option value="created">Creado</option>
                    <option value="updated">Actualizado</option>
                    <option value="deleted">Eliminado</option>
                </select>
            </div>

        </div>

        {{-- Tabla de Logs --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="p-3 text-left font-semibold">Fecha/Hora</th>
                        <th class="p-3 text-left font-semibold">Usuario</th>
                        <th class="p-3 text-left font-semibold">Acción</th>
                        <th class="p-3 text-left font-semibold">Modelo</th>
                        <th class="p-3 text-left font-semibold">Cambios</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr class="border-b hover:bg-gray-50">
                            
                            {{-- Fecha --}}
                            <td class="p-3 whitespace-nowrap">
                                <div class="text-xs text-gray-600">
                                    {{ $log->created_at->format('d/m/Y') }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $log->created_at->format('H:i:s') }}
                                </div>
                            </td>

                            {{-- Usuario --}}
                            <td class="p-3">
                                @if($log->causer)
                                    <span class="font-medium">{{ $log->causer->name }}</span>
                                    <div class="text-xs text-gray-500">{{ $log->causer->email }}</div>
                                @else
                                    <span class="text-gray-400 italic">Sistema</span>
                                @endif
                            </td>

                            {{-- Acción --}}
                            <td class="p-3">
                                @php
                                    $eventMap = [
                                        'created' => ['bg-green-100 text-green-700', 'Creado'],
                                        'updated' => ['bg-blue-100 text-blue-700', 'Actualizado'],
                                        'deleted' => ['bg-red-100 text-red-700', 'Eliminado'],
                                    ];
                                    
                                    $eventName = str_replace(['Noticia ', 'Convocatoria ', 'Autoridad ', 'Documento '], '', $log->description);
                                    $eventColors = $eventMap[$eventName] ?? ['bg-gray-100 text-gray-700', $eventName];
                                @endphp
                                
                                <span class="px-2 py-1 text-xs rounded font-medium {{ $eventColors[0] }}">
                                    {{ $eventColors[1] }}
                                </span>
                            </td>

                            {{-- Modelo --}}
                            <td class="p-3">
                                <span class="font-medium">{{ class_basename($log->subject_type) }}</span>
                                @if($log->subject)
                                    <div class="text-xs text-gray-500">
                                        ID: {{ $log->subject_id }}
                                    </div>
                                @endif
                            </td>

                            {{-- Cambios --}}
                            <td class="p-3">
                                @if($log->properties->isNotEmpty())
                                    <button 
                                        onclick="alert('{{ addslashes(json_encode($log->properties, JSON_PRETTY_PRINT)) }}')"
                                        class="text-blue-600 hover:text-blue-800 text-xs font-medium">
                                        Ver detalles
                                    </button>
                                    
                                    <div class="text-xs text-gray-500 mt-1">
                                        @if($log->properties->has('attributes'))
                                            {{ count($log->properties->get('attributes', [])) }} campos
                                        @endif
                                    </div>
                                @else
                                    <span class="text-gray-400 text-xs">Sin cambios</span>
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-gray-500">
                                No hay logs de auditoría registrados
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginación --}}
        <div class="mt-6">
            {{ $logs->links() }}
        </div>

    </div>

    {{-- Estadísticas --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6">
        
        <div class="bg-white shadow rounded p-4">
            <div class="text-sm text-gray-600">Total de Logs</div>
            <div class="text-2xl font-bold text-gray-800">{{ $logs->total() }}</div>
        </div>

        <div class="bg-green-50 shadow rounded p-4">
            <div class="text-sm text-green-600">Creaciones</div>
            <div class="text-2xl font-bold text-green-700">
                {{ \Spatie\Activitylog\Models\Activity::where('description', 'like', '%created%')->count() }}
            </div>
        </div>

        <div class="bg-blue-50 shadow rounded p-4">
            <div class="text-sm text-blue-600">Actualizaciones</div>
            <div class="text-2xl font-bold text-blue-700">
                {{ \Spatie\Activitylog\Models\Activity::where('description', 'like', '%updated%')->count() }}
            </div>
        </div>

        <div class="bg-red-50 shadow rounded p-4">
            <div class="text-sm text-red-600">Eliminaciones</div>
            <div class="text-2xl font-bold text-red-700">
                {{ \Spatie\Activitylog\Models\Activity::where('description', 'like', '%deleted%')->count() }}
            </div>
        </div>

    </div>

</div>
