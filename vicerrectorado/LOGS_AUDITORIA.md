# Sistema de Auditoría (Activity Log)

## 📋 Descripción

Sistema completo de logs de auditoría implementado con **Spatie Activity Log** que registra automáticamente todas las acciones importantes en el sistema del Vicerrectorado Académico.

## ✅ Características Implementadas

### 1. **Registro Automático en Modelos**
Los siguientes modelos registran automáticamente las acciones:
- ✅ **Noticias** - Creación, edición, eliminación
- ✅ **Convocatorias** - Creación, edición, eliminación
- ✅ **Autoridades** - Creación, edición, eliminación
- ✅ **Documentos Académicos** - Creación, edición, eliminación

### 2. **Información Registrada**
Cada log incluye:
- 📅 **Fecha y hora** exacta de la acción
- 👤 **Usuario** que realizó la acción
- 🎯 **Tipo de acción** (created, updated, deleted)
- 📝 **Modelo afectado** y su ID
- 🔄 **Cambios específicos** (solo campos modificados)
- 🌐 **IP y User Agent** (para algunas acciones)

### 3. **Interfaz de Administración**
Panel completo en `/admin/logs` con:
- 📊 **Tabla filtrable** de todos los logs
- 🔍 **Búsqueda** por texto
- 🎯 **Filtros** por modelo y tipo de evento
- 📈 **Estadísticas** visuales (total, creaciones, actualizaciones, eliminaciones)
- 📄 **Paginación** eficiente (20 logs por página)
- 🔎 **Vista detallada** de cambios en formato JSON

## 🚀 Uso

### Acceso al Panel de Logs
1. Inicia sesión como administrador
2. Ve al menú lateral → **📋 Logs de Auditoría**
3. Explora los registros con los filtros disponibles

### Configuración de Nuevos Modelos
Para agregar auditoría a un nuevo modelo:

```php
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class TuModelo extends Model
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['campo1', 'campo2', 'campo3'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "TuModelo {$eventName}");
    }
}
```

### Helper para Logs Personalizados
Usa la clase `ActivityLogger` para registrar eventos personalizados:

```php
use App\Helpers\ActivityLogger;

// Log simple
ActivityLogger::log('Descripción de la acción');

// Log con propiedades
ActivityLogger::log('Exportó reporte', null, [
    'tipo_reporte' => 'mensual',
    'formato' => 'PDF'
]);

// Logs predefinidos
ActivityLogger::logLogin($user);
ActivityLogger::logLogout($user);
ActivityLogger::logConfigChange('banner_titulo', 'Viejo', 'Nuevo');
ActivityLogger::logSearch('convocatorias', 'admin');
```

## 📁 Archivos Principales

```
app/
├── Helpers/
│   └── ActivityLogger.php          # Helper para logs personalizados
├── Livewire/Admin/Logs/
│   └── Index.php                   # Componente Livewire del panel
├── Models/
│   ├── Noticia.php                 # Con trait LogsActivity
│   ├── Convocatoria.php            # Con trait LogsActivity
│   ├── Autoridad.php               # Con trait LogsActivity
│   └── DocumentoAcademico.php      # Con trait LogsActivity
├── Observers/
│   └── ActivityLogObserver.php     # Observer para asociar usuario
└── Providers/
    └── AppServiceProvider.php      # Registro del observer

config/
└── activitylog.php                 # Configuración del paquete

database/migrations/
└── xxxx_create_activity_log_table.php  # Migración de la tabla

resources/views/livewire/admin/logs/
└── index.blade.php                 # Vista del panel de logs

routes/
└── web.php                         # Ruta: /admin/logs
```

## 🎨 Características de la Interfaz

### Tabla de Logs
- **Colores por tipo de evento:**
  - 🟢 Verde: Creaciones
  - 🔵 Azul: Actualizaciones
  - 🔴 Rojo: Eliminaciones

### Filtros Disponibles
1. **Búsqueda de texto** - Busca en descripciones y propiedades
2. **Filtro por modelo** - Noticias, Convocatorias, Autoridades, etc.
3. **Filtro por evento** - created, updated, deleted

### Estadísticas en Tiempo Real
- Total de logs registrados
- Contador de creaciones
- Contador de actualizaciones
- Contador de eliminaciones

## 🔐 Seguridad

- ✅ Solo accesible para usuarios con rol **admin**
- ✅ Los logs son **inmutables** (no se pueden editar)
- ✅ Se registra automáticamente el usuario autenticado
- ✅ Protegido con middleware de autenticación

## 📊 Base de Datos

La tabla `activity_log` contiene:
- `id` - ID único del log
- `log_name` - Nombre del log (opcional)
- `description` - Descripción de la acción
- `subject_type` - Clase del modelo afectado
- `subject_id` - ID del registro afectado
- `causer_type` - Clase del usuario (User)
- `causer_id` - ID del usuario que realizó la acción
- `properties` - JSON con los cambios (old/new values)
- `batch_uuid` - UUID para agrupar logs relacionados
- `created_at` - Fecha y hora de la acción

## 🎯 Mejoras Futuras

Posibles extensiones del sistema:
- [ ] Exportar logs a CSV/Excel
- [ ] Gráficos de actividad por usuario
- [ ] Alertas por acciones críticas
- [ ] Retención automática (eliminar logs antiguos)
- [ ] Dashboard de actividad en tiempo real
- [ ] Integración con sistema de notificaciones
- [ ] Logs de accesos fallidos
- [ ] Auditoría de cambios en configuración del sistema

## 📚 Documentación Oficial

Para más información: [Spatie Activity Log Documentation](https://spatie.be/docs/laravel-activitylog)

---

**Desarrollado para:** Vicerrectorado Académico  
**Fecha:** Febrero 2026  
**Versión:** 1.0
