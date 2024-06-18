document.addEventListener('DOMContentLoaded', () => {
    const progressBar = document.getElementById('progress');
    const totalLoadTime = 5000;
    const maxPauseTime = 500;
    const minIntervalTime = 30;
    const maxIntervalTime = 70;
    let width = 0;
    let isPaused = false;

    const urlParams = new URLSearchParams(window.location.search);
    const redirectUrl = urlParams.get('url');

    if (!redirectUrl) {
        let mensaje = "Porfavor, elige un juego";
        let direccion = "http://localhost/informatica/biblioteca/selecciona_juego_prueba.php";

        alert(mensaje);
        window.location.href = direccion;
    }

    function updateProgressBar() {
        if (!isPaused) {
            width += Math.random() * 2; // Incremento aleatorio
            progressBar.style.width = width + '%';
        }

        // Pausar de forma aleatoria
        if (Math.random() < 0.1 && !isPaused) { // Probabilidad de pausa
            isPaused = true;
            const pauseTime = Math.random() * maxPauseTime; // Pausa aleatoria
            setTimeout(() => {
                isPaused = false;
                setTimeout(updateProgressBar, Math.random() * (maxIntervalTime - minIntervalTime) + minIntervalTime);
            }, pauseTime);
        } else {
            if (width >= 100) {
                window.location.href = redirectUrl;
            } else {
                setTimeout(updateProgressBar, Math.random() * (maxIntervalTime - minIntervalTime) + minIntervalTime);
            }
        }
    }

    updateProgressBar();
});
