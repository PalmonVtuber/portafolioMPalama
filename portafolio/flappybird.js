window.onload = function() {
    const canvas = document.getElementById("flappyCanvas");
    const ctx = canvas.getContext("2d");

    canvas.width = 320;
    canvas.height = 480;

    // Carga de imágenes
    const birdImg = new Image();
    const bgImg = new Image();
    const fgImg = new Image();
    const pipeNorth = new Image();
    const pipeSouth = new Image();

    birdImg.src = "imagenes/flappybird/bird.png";
    bgImg.src = "imagenes/flappybird/background.png";
    fgImg.src = "imagenes/flappybird/foreground.png";
    pipeNorth.src = "imagenes/flappybird/pipeNorth.png";
    pipeSouth.src = "imagenes/flappybird/pipeSouth.png";

    // Variables
    let gap = 85;
    let constant = pipeNorth.height + gap;
    let bX = 10;
    let bY = 150;
    let gravity = 1.5;

    let pipe = [];
    pipe[0] = {
        x: canvas.width,
        y: 0
    };

    // Control de pájaro
    document.addEventListener("keydown", moveUp);

    function moveUp() {
        bY -= 25;
    }

    // Dibujar imágenes
    function draw() {
        ctx.drawImage(bgImg, 0, 0);

        for(let i = 0; i < pipe.length; i++) {
            ctx.drawImage(pipeNorth, pipe[i].x, pipe[i].y);
            ctx.drawImage(pipeSouth, pipe[i].x, pipe[i].y + constant);
            
            pipe[i].x--;

            if(pipe[i].x == 125) {
                pipe.push({
                    x: canvas.width,
                    y: Math.floor(Math.random() * pipeNorth.height) - pipeNorth.height
                });
            }

            if(bX + birdImg.width >= pipe[i].x && bX <= pipe[i].x + pipeNorth.width && (bY <= pipe[i].y + pipeNorth.height || bY + birdImg.height >= pipe[i].y + constant) || bY + birdImg.height >= canvas.height - fgImg.height) {
                location.reload(); // Recargar la página si colisiona
            }
        }

        ctx.drawImage(fgImg, 0, canvas.height - fgImg.height);
        ctx.drawImage(birdImg, bX, bY);

        bY += gravity;

        requestAnimationFrame(draw);
    }

    draw();
};

function gameOver() {
    let puntaje = score; // Asumiendo que 'score' es la variable que guarda el puntaje

    // Envía el puntaje al servidor
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "guardar_puntaje.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log("Puntaje guardado");
        }
    };
    xhr.send("puntaje=" + puntaje + "&juego_id=2"); // Aquí '2' es el ID de Flappy Bird en tu base de datos
}
