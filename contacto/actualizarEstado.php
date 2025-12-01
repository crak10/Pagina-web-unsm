<?php
/**
 * Cargar WordPress
 * Integración de WordPress en la página de actualizar estado
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
    <title>Detalle del Mensaje - UNSM</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f3f4f6;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        .header {
            background: linear-gradient(135deg, #359444 0%, #2a7a35 100%);
            color: white;
            padding: 20px 30px;
            border-radius: 8px 8px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 24px;
        }

        .btn-back {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            transition: background 0.2s;
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .content {
            background: white;
            padding: 30px;
            border-radius: 0 0 8px 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-item {
            padding: 15px;
            background: #f9fafb;
            border-radius: 6px;
            border-left: 3px solid #359444;
        }

        .info-item label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .info-item .value {
            font-size: 15px;
            color: #1f2937;
            word-break: break-word;
        }

        .message-section {
            margin: 30px 0;
            padding: 20px;
            background: #fafafa;
            border-radius: 6px;
        }

        .message-section h2 {
            font-size: 18px;
            color: #359444;
            margin-bottom: 15px;
        }

        .message-text {
            font-size: 15px;
            line-height: 1.7;
            color: #374151;
            white-space: pre-wrap;
        }

        .actions {
            display: flex;
            gap: 10px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.2s;
        }

        .btn-primary {
            background-color: #359444;
            color: white;
        }

        .btn-primary:hover {
            background-color: #2a7a35;
        }

        .btn-secondary {
            background-color: #6b7280;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #4b5563;
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
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

        .metadata {
            display: flex;
            gap: 20px;
            padding: 15px;
            background: #f3f4f6;
            border-radius: 6px;
            margin-top: 20px;
            font-size: 13px;
            color: #6b7280;
        }

        .metadata-item {
            display: flex;
            flex-direction: column;
        }

        .metadata-item strong {
            color: #374151;
            margin-bottom: 2px;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 15px 20px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }

            .header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .actions {
                flex-direction: column;
            }

            .btn {
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        // Incluir configuración
        require_once 'config/db_config.php';

        // Verificar ID
        if (!isset($_GET['id'])) {
            echo '<div class="error">ID de mensaje no proporcionado.</div>';
            echo '<a href="admin_mensajes.php" class="btn btn-primary">Volver al Panel</a>';
            exit;
        }

        $id = intval($_GET['id']);

        try {
            // Conectar a la base de datos
            $conn = getDBConnection();

            // Obtener el mensaje
            $sql = "SELECT * FROM mensajes_contacto WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 0) {
                echo '<div class="error">Mensaje no encontrado.</div>';
                echo '<a href="admin_mensajes.php" class="btn btn-primary">Volver al Panel</a>';
                exit;
            }

            $mensaje = $result->fetch_assoc();
            $stmt->close();
            closeDBConnection($conn);

        } catch (Exception $e) {
            echo '<div class="error"><strong>Error:</strong> ' . $e->getMessage() . '</div>';
            echo '<a href="admin_mensajes.php" class="btn btn-primary">Volver al Panel</a>';
            exit;
        }
        ?>

        <div class="header">
            <h1>📧 Detalle del Mensaje #<?php echo $mensaje['id']; ?></h1>
            <a href="admin_mensajes.php" class="btn-back">← Volver</a>
        </div>

        <div class="content">
            <div style="margin-bottom: 20px;">
                <span class="badge badge-<?php echo $mensaje['estado']; ?>">
                    <?php echo ucfirst($mensaje['estado']); ?>
                </span>
            </div>

            <div class="info-grid">
                <div class="info-item">
                    <label>Nombre Completo</label>
                    <div class="value"><?php echo htmlspecialchars($mensaje['nombre']); ?></div>
                </div>

                <div class="info-item">
                    <label>DNI</label>
                    <div class="value"><?php echo htmlspecialchars($mensaje['dni']); ?></div>
                </div>

                <div class="info-item">
                    <label>Teléfono</label>
                    <div class="value">
                        <a href="tel:<?php echo $mensaje['telefono']; ?>" style="color: #359444; text-decoration: none;">
                            <?php echo htmlspecialchars($mensaje['telefono']); ?>
                        </a>
                    </div>
                </div>

                <div class="info-item">
                    <label>Correo Electrónico</label>
                    <div class="value">
                        <a href="mailto:<?php echo $mensaje['correo']; ?>" style="color: #359444; text-decoration: none;">
                            <?php echo htmlspecialchars($mensaje['correo']); ?>
                        </a>
                    </div>
                </div>

                <div class="info-item">
                    <label>Oficina Destinataria</label>
                    <div class="value"><?php echo htmlspecialchars(ucfirst($mensaje['oficina'])); ?></div>
                </div>

                <div class="info-item">
                    <label>Fecha de Envío</label>
                    <div class="value"><?php echo date('d/m/Y H:i:s', strtotime($mensaje['fecha_envio'])); ?></div>
                </div>
            </div>

            <div class="message-section">
                <h2>💬 Mensaje</h2>
                <div class="message-text"><?php echo nl2br(htmlspecialchars($mensaje['mensaje'])); ?></div>
            </div>

            <div class="metadata">
                <div class="metadata-item">
                    <strong>IP Address:</strong>
                    <span><?php echo htmlspecialchars($mensaje['ip_address']); ?></span>
                </div>
                <div class="metadata-item">
                    <strong>User Agent:</strong>
                    <span><?php echo htmlspecialchars(substr($mensaje['user_agent'], 0, 80)) . '...'; ?></span>
                </div>
            </div>

            <div class="actions">
                <?php if ($mensaje['estado'] == 'pendiente'): ?>
                    <a href="actualizar_estado.php?id=<?php echo $mensaje['id']; ?>&estado=leido" 
                       class="btn btn-primary"
                       onclick="return confirm('¿Marcar como leído?')">
                        Marcar como Leído
                    </a>
                <?php endif; ?>

                <?php if ($mensaje['estado'] == 'leido'): ?>
                    <a href="actualizar_estado.php?id=<?php echo $mensaje['id']; ?>&estado=respondido" 
                       class="btn btn-primary"
                       onclick="return confirm('¿Marcar como respondido?')">
                        Marcar como Respondido
                    </a>
                <?php endif; ?>

                <a href="mailto:<?php echo $mensaje['correo']; ?>?subject=Re: Tu mensaje a UNSM&body=Hola <?php echo urlencode($mensaje['nombre']); ?>,%0D%0A%0D%0AGracias por contactarte con la UNSM.%0D%0A%0D%0A" 
                   class="btn btn-secondary">
                    Responder por Email
                </a>

                <a href="admin_mensajes.php" class="btn btn-secondary">
                    Volver al Panel
                </a>
            </div>
        </div>
    </div>
</body>
</html>