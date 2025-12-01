<?php
/**
 * Cargar WordPress
 * Integración de WordPress en el panel de administración de mensajes
 */
$wp_load_path = __DIR__ . '/../wordpress/wp-load.php';
$wp_config_path = __DIR__ . '/../wordpress/wp-config.php';
$wp_compat_path = __DIR__ . '/../wordpress/wp-includes/compat.php';

// Verificar si WordPress está instalado y configurado antes de cargar
if (file_exists($wp_load_path) && file_exists($wp_config_path) && file_exists($wp_compat_path)) {
    require_once($wp_load_path);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Mensajes de Contacto UNSM</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            background-color: #f3f4f6;
            padding: 20px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .header {
            background: linear-gradient(135deg, #359444 0%, #2a7a35 100%);
            color: white;
            padding: 30px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .header p {
            opacity: 0.9;
            font-size: 14px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        .stat-card .number {
            font-size: 36px;
            font-weight: 700;
            color: #359444;
            margin-bottom: 5px;
        }

        .stat-card .label {
            font-size: 14px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .filters {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .filters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            align-items: end;
        }

        .filter-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 5px;
        }

        .filter-group select,
        .filter-group input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            font-size: 14px;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-primary {
            background-color: #359444;
            color: white;
        }

        .btn-primary:hover {
            background-color: #2a7a35;
        }

        .table-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #359444;
            color: white;
        }

        thead th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tbody tr {
            border-bottom: 1px solid #e5e7eb;
            transition: background-color 0.2s;
        }

        tbody tr:hover {
            background-color: #f9fafb;
        }

        tbody td {
            padding: 15px;
            font-size: 14px;
            color: #374151;
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .badge-pendiente {
            background-color: #fef3c7;
            color: #92400e;
        }

        .badge-leido {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .badge-respondido {
            background-color: #d1fae5;
            color: #065f46;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
        }

        .btn-info {
            background-color: #3b82f6;
            color: white;
        }

        .btn-success {
            background-color: #10b981;
            color: white;
        }

        .mensaje-preview {
            max-width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .no-data {
            text-align: center;
            padding: 60px 20px;
            color: #6b7280;
            font-size: 16px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            padding: 20px;
        }

        @media (max-width: 768px) {
            .table-container {
                overflow-x: auto;
            }

            table {
                min-width: 800px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📧 Panel de Administración de Mensajes</h1>
            <p>Universidad Nacional de San Martín - Gestión de Contactos</p>
        </div>

        <?php
        // Incluir configuración de base de datos
        require_once 'config/db_config.php';

        try {
            // Conectar a la base de datos
            $conn = getDBConnection();

            // Obtener estadísticas
            $sqlStats = "
                SELECT 
                    COUNT(*) as total,
                    SUM(CASE WHEN estado = 'pendiente' THEN 1 ELSE 0 END) as pendientes,
                    SUM(CASE WHEN estado = 'leido' THEN 1 ELSE 0 END) as leidos,
                    SUM(CASE WHEN estado = 'respondido' THEN 1 ELSE 0 END) as respondidos
                FROM mensajes_contacto
            ";
            $resultStats = $conn->query($sqlStats);
            $stats = $resultStats->fetch_assoc();

            // Obtener filtros
            $filtroEstado = isset($_GET['estado']) ? $_GET['estado'] : '';
            $filtroOficina = isset($_GET['oficina']) ? $_GET['oficina'] : '';
            $filtroBusqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';

            // Construir consulta con filtros
            $sql = "SELECT * FROM mensajes_contacto WHERE 1=1";
            
            if (!empty($filtroEstado)) {
                $sql .= " AND estado = '" . $conn->real_escape_string($filtroEstado) . "'";
            }
            
            if (!empty($filtroOficina)) {
                $sql .= " AND oficina = '" . $conn->real_escape_string($filtroOficina) . "'";
            }
            
            if (!empty($filtroBusqueda)) {
                $busqueda = $conn->real_escape_string($filtroBusqueda);
                $sql .= " AND (nombre LIKE '%$busqueda%' OR correo LIKE '%$busqueda%' OR dni LIKE '%$busqueda%')";
            }
            
            $sql .= " ORDER BY fecha_envio DESC LIMIT 50";

            $result = $conn->query($sql);

            // Obtener oficinas para el filtro
            $sqlOficinas = "SELECT DISTINCT oficina FROM mensajes_contacto ORDER BY oficina";
            $resultOficinas = $conn->query($sqlOficinas);

        } catch (Exception $e) {
            echo "<div style='background: #fee2e2; color: #991b1b; padding: 20px; border-radius: 8px; margin-bottom: 20px;'>";
            echo "<strong>Error:</strong> " . $e->getMessage();
            echo "</div>";
            exit;
        }
        ?>

        <!-- Estadísticas -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="number"><?php echo $stats['total']; ?></div>
                <div class="label">Total Mensajes</div>
            </div>
            <div class="stat-card">
                <div class="number"><?php echo $stats['pendientes']; ?></div>
                <div class="label">Pendientes</div>
            </div>
            <div class="stat-card">
                <div class="number"><?php echo $stats['leidos']; ?></div>
                <div class="label">Leídos</div>
            </div>
            <div class="stat-card">
                <div class="number"><?php echo $stats['respondidos']; ?></div>
                <div class="label">Respondidos</div>
            </div>
        </div>

        <!-- Filtros -->
        <div class="filters">
            <form method="GET" action="">
                <div class="filters-grid">
                    <div class="filter-group">
                        <label>Estado:</label>
                        <select name="estado">
                            <option value="">Todos</option>
                            <option value="pendiente" <?php echo $filtroEstado == 'pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                            <option value="leido" <?php echo $filtroEstado == 'leido' ? 'selected' : ''; ?>>Leído</option>
                            <option value="respondido" <?php echo $filtroEstado == 'respondido' ? 'selected' : ''; ?>>Respondido</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>Oficina:</label>
                        <select name="oficina">
                            <option value="">Todas</option>
                            <?php while ($oficina = $resultOficinas->fetch_assoc()): ?>
                                <option value="<?php echo htmlspecialchars($oficina['oficina']); ?>" 
                                        <?php echo $filtroOficina == $oficina['oficina'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($oficina['oficina']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>Buscar:</label>
                        <input type="text" name="busqueda" placeholder="Nombre, correo o DNI" 
                               value="<?php echo htmlspecialchars($filtroBusqueda); ?>">
                    </div>
                    <div class="filter-group">
                        <button type="submit" class="btn btn-primary">Filtrar</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tabla de mensajes -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Nombre</th>
                        <th>DNI</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Oficina</th>
                        <th>Mensaje</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo date('d/m/Y H:i', strtotime($row['fecha_envio'])); ?></td>
                                <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($row['dni']); ?></td>
                                <td><?php echo htmlspecialchars($row['telefono']); ?></td>
                                <td><?php echo htmlspecialchars($row['correo']); ?></td>
                                <td><?php echo htmlspecialchars($row['oficina']); ?></td>
                                <td>
                                    <div class="mensaje-preview" title="<?php echo htmlspecialchars($row['mensaje']); ?>">
                                        <?php echo htmlspecialchars(substr($row['mensaje'], 0, 50)) . '...'; ?>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-<?php echo $row['estado']; ?>">
                                        <?php echo ucfirst($row['estado']); ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <button class="btn btn-sm btn-info" onclick="verDetalle(<?php echo $row['id']; ?>)">Ver</button>
                                        <?php if ($row['estado'] == 'pendiente'): ?>
                                            <button class="btn btn-sm btn-success" onclick="marcarLeido(<?php echo $row['id']; ?>)">Leído</button>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10" class="no-data">
                                No se encontraron mensajes con los filtros aplicados.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php
        closeDBConnection($conn);
        ?>
    </div>

    <script>
        function verDetalle(id) {
            window.location.href = 'ver_mensaje.php?id=' + id;
        }

        function marcarLeido(id) {
            if (confirm('¿Marcar este mensaje como leído?')) {
                window.location.href = 'actualizar_estado.php?id=' + id + '&estado=leido';
            }
        }
    </script>
</body>
</html>