<?php
// Muestra con SweetAlert2 los errores ($errores) y mensajes de exito ($mensaje_exito)
// o de estado ($mensaje_status = ['ok'|'error', 'texto']) que tenga definida la pagina.
$base = $base ?? '';
$errores = $errores ?? [];
$mensaje_exito = $mensaje_exito ?? '';
$mensaje_status = $mensaje_status ?? null;

$alerta = null;
if (empty($errores)) {
    if ($mensaje_exito !== '') {
        $alerta = ['icon' => 'success', 'title' => $mensaje_exito];
    } elseif ($mensaje_status) {
        $alerta = ['icon' => $mensaje_status[0] === 'ok' ? 'success' : 'error', 'title' => $mensaje_status[1]];
    }
}
?>
<?php if (!empty($errores) || $alerta): ?>
    <script src="<?= $base ?>build/js/sweetalert2.all.min.js"></script>
    <script>
        <?php if (!empty($errores)): ?>
        // Los errores salen como toast, uno por uno
        const toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
        // await dentro del for muestra cada toast cuando termina el anterior
        (async () => {
            for (const error of <?= json_encode(array_values($errores), JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP) ?>) {
                await toast.fire({ icon: 'error', title: error });
            }
        })();
        <?php else: ?>
        // json_encode pasa el array PHP a JS; HEX_TAG/HEX_AMP escapan < > & por seguridad
        Swal.fire(<?= json_encode($alerta, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP) ?>);
        <?php endif; ?>
    </script>
<?php endif; ?>
