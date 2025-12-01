/**
 * =====================================================
 * SCRIPT MEJORADO CON DEBUG - UNSM
 * scricpContac.js (versión corregida)
 * =====================================================
 */

document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.contact-form');
    const submitButton = form.querySelector('.btn-contact-submit');
    const originalButtonText = submitButton.textContent;

    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            // Validar el formulario antes de enviar
            if (!validarFormulario()) {
                return;
            }

            // Deshabilitar el botón y mostrar estado de carga
            submitButton.disabled = true;
            submitButton.textContent = 'Enviando...';
            submitButton.style.backgroundColor = '#6b7280';

            // Obtener los datos del formulario
            const formData = new FormData(form);

            // CAMBIO IMPORTANTE: Usar el nombre correcto del archivo
            // Si tu archivo se llama "procesarContacto.php" (sin guion), usa esta línea:
            const urlProcesar = 'procesarContacto.php';
            
            // Si tu archivo se llama "procesar_contacto.php" (con guion), usa esta línea:
            // const urlProcesar = 'procesar_contacto.php';

            console.log('📤 Enviando formulario a:', urlProcesar);
            console.log('📦 Datos del formulario:', Object.fromEntries(formData));

            // Enviar datos mediante AJAX
            fetch(urlProcesar, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                console.log('📥 Respuesta recibida:', response);
                console.log('📊 Status:', response.status);
                console.log('📋 Content-Type:', response.headers.get('content-type'));
                
                // Primero obtener el texto de la respuesta
                return response.text().then(text => {
                    console.log('📄 Respuesta como texto:', text);
                    
                    // Intentar parsear como JSON
                    try {
                        const data = JSON.parse(text);
                        return { ok: response.ok, data: data };
                    } catch (e) {
                        console.error('❌ Error al parsear JSON:', e);
                        console.error('📄 Respuesta recibida:', text);
                        throw new Error('El servidor devolvió una respuesta no válida. Revisa la consola para más detalles.');
                    }
                });
            })
            .then(({ ok, data }) => {
                console.log('✅ Datos parseados:', data);
                
                if (data.success) {
                    // Mostrar mensaje de éxito
                    mostrarMensaje('success', data.message);
                    
                    // Limpiar el formulario
                    form.reset();
                } else {
                    // Mostrar errores de validación del servidor
                    if (data.errores && data.errores.length > 0) {
                        mostrarMensaje('error', data.errores.join('<br>'));
                    } else {
                        mostrarMensaje('error', data.message);
                    }
                }
            })
            .catch(error => {
                console.error('❌ Error completo:', error);
                
                let mensajeError = 'Hubo un error al enviar el formulario. ';
                mensajeError += 'Abre la consola del navegador (F12) para ver más detalles.';
                
                if (error.message) {
                    mensajeError += '<br><br><strong>Error:</strong> ' + error.message;
                }
                
                mostrarMensaje('error', mensajeError);
            })
            .finally(() => {
                // Rehabilitar el botón
                submitButton.disabled = false;
                submitButton.textContent = originalButtonText;
                submitButton.style.backgroundColor = '#359444';
            });
        });
    }

    /**
     * Función para validar el formulario del lado del cliente
     */
    function validarFormulario() {
        let esValido = true;
        let errores = [];

        // Obtener los valores de los campos
        const nombre = document.getElementById('nombre').value.trim();
        const dni = document.getElementById('dni').value.trim();
        const telefono = document.getElementById('telefono').value.trim();
        const correo = document.getElementById('correo').value.trim();
        const oficina = document.getElementById('oficina').value;
        const mensaje = document.getElementById('mensaje').value.trim();

        console.log('🔍 Validando formulario:', { nombre, dni, telefono, correo, oficina, mensaje });

        // Validar nombre
        if (nombre === '') {
            errores.push('El nombre es obligatorio');
            esValido = false;
        } else if (nombre.length < 3) {
            errores.push('El nombre debe tener al menos 3 caracteres');
            esValido = false;
        }

        // Validar DNI
        if (dni === '') {
            errores.push('El DNI es obligatorio');
            esValido = false;
        } else if (!/^[0-9]{8}$/.test(dni)) {
            errores.push('El DNI debe tener 8 dígitos');
            esValido = false;
        }

        // Validar teléfono
        if (telefono === '') {
            errores.push('El teléfono es obligatorio');
            esValido = false;
        } else if (!/^9[0-9]{8}$/.test(telefono.replace(/\D/g, ''))) {
            errores.push('El teléfono debe ser un número válido (9 dígitos empezando con 9)');
            esValido = false;
        }

        // Validar correo
        if (correo === '') {
            errores.push('El correo electrónico es obligatorio');
            esValido = false;
        } else if (!validarEmail(correo)) {
            errores.push('El correo electrónico no es válido');
            esValido = false;
        }

        // Validar oficina
        if (oficina === '' || oficina === null) {
            errores.push('Debe seleccionar una oficina');
            esValido = false;
        }

        // Validar mensaje
        if (mensaje === '') {
            errores.push('El mensaje es obligatorio');
            esValido = false;
        } else if (mensaje.length < 10) {
            errores.push('El mensaje debe tener al menos 10 caracteres');
            esValido = false;
        }

        // Mostrar errores si los hay
        if (!esValido) {
            console.log('❌ Errores de validación:', errores);
            mostrarMensaje('error', errores.join('<br>'));
        } else {
            console.log('✅ Formulario válido');
        }

        return esValido;
    }

    /**
     * Función para validar formato de email
     */
    function validarEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }

    /**
     * Función para mostrar mensajes al usuario
     */
    function mostrarMensaje(tipo, mensaje) {
        // Remover mensaje anterior si existe
        const mensajeAnterior = document.querySelector('.mensaje-formulario');
        if (mensajeAnterior) {
            mensajeAnterior.remove();
        }

        // Crear elemento de mensaje
        const divMensaje = document.createElement('div');
        divMensaje.className = `mensaje-formulario mensaje-${tipo}`;
        divMensaje.innerHTML = mensaje;

        // Estilos del mensaje
        divMensaje.style.cssText = `
            padding: 15px 20px;
            margin-bottom: 20px;
            border-radius: 4px;
            font-size: 14px;
            line-height: 1.6;
            animation: slideDown 0.3s ease-out;
        `;

        if (tipo === 'success') {
            divMensaje.style.backgroundColor = '#d4edda';
            divMensaje.style.color = '#155724';
            divMensaje.style.border = '1px solid #c3e6cb';
        } else if (tipo === 'error') {
            divMensaje.style.backgroundColor = '#f8d7da';
            divMensaje.style.color = '#721c24';
            divMensaje.style.border = '1px solid #f5c6cb';
        }

        // Insertar el mensaje antes del formulario
        form.parentNode.insertBefore(divMensaje, form);

        // Scroll suave hacia el mensaje
        divMensaje.scrollIntoView({ behavior: 'smooth', block: 'center' });

        // Remover el mensaje después de 8 segundos
        setTimeout(() => {
            divMensaje.style.animation = 'slideUp 0.3s ease-out';
            setTimeout(() => divMensaje.remove(), 300);
        }, 8000);
    }

    // Agregar estilos de animación
    if (!document.getElementById('mensaje-animacion-styles')) {
        const style = document.createElement('style');
        style.id = 'mensaje-animacion-styles';
        style.textContent = `
            @keyframes slideDown {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            @keyframes slideUp {
                from {
                    opacity: 1;
                    transform: translateY(0);
                }
                to {
                    opacity: 0;
                    transform: translateY(-20px);
                }
            }
        `;
        document.head.appendChild(style);
    }

    // Validación en tiempo real para DNI (solo números)
    const dniInput = document.getElementById('dni');
    if (dniInput) {
        dniInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/\D/g, '').slice(0, 8);
        });
    }

    // Validación en tiempo real para teléfono (solo números)
    const telefonoInput = document.getElementById('telefono');
    if (telefonoInput) {
        telefonoInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/\D/g, '').slice(0, 9);
        });
    }
});