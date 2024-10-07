const canvas = document.getElementById('gameCanvas');
const ctx = canvas.getContext('2d');
const box = 20; // Tamaño de cada cuadrado

// La serpiente
let snake = [];
snake[0] = { x: 10 * box, y: 10 * box };

// La comida
let food = {
    x: Math.floor(Math.random() * 19 + 1) * box,
    y: Math.floor(Math.random() * 19 + 1) * box
};

let score = 0;
let direction;

// Control de la dirección
document.addEventListener('keydown', event => {
    if (event.key === 'ArrowUp' && direction !== 'DOWN') direction = 'UP';
    else if (event.key === 'ArrowDown' && direction !== 'UP') direction = 'DOWN';
    else if (event.key === 'ArrowLeft' && direction !== 'RIGHT') direction = 'LEFT';
    else if (event.key === 'ArrowRight' && direction !== 'LEFT') direction = 'RIGHT';
});

function collision(newHead, snake) {
    for (let i = 0; i < snake.length; i++) {
        if (newHead.x === snake[i].x && newHead.y === snake[i].y) return true;
    }
    return false;
}

function drawGame() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    
    // Dibujar la serpiente
    for (let i = 0; i < snake.length; i++) {
        ctx.fillStyle = i === 0 ? 'green' : 'white';
        ctx.fillRect(snake[i].x, snake[i].y, box, box);
        ctx.strokeStyle = 'black';
        ctx.strokeRect(snake[i].x, snake[i].y, box, box);
    }

    // Dibujar la comida
    ctx.fillStyle = 'red';
    ctx.fillRect(food.x, food.y, box, box);

    // Posición actual de la cabeza
    let snakeX = snake[0].x;
    let snakeY = snake[0].y;

    // Movimiento de la serpiente
    if (direction === 'UP') snakeY -= box;
    if (direction === 'DOWN') snakeY += box;
    if (direction === 'LEFT') snakeX -= box;
    if (direction === 'RIGHT') snakeX += box;

    // Comida
    if (snakeX === food.x && snakeY === food.y) {
        score++;
        document.getElementById('score').innerText = score;
        food = {
            x: Math.floor(Math.random() * 19 + 1) * box,
            y: Math.floor(Math.random() * 19 + 1) * box
        };
    } else {
        // Remover la última parte de la serpiente
        snake.pop();
    }

    // Nueva cabeza de la serpiente
    let newHead = { x: snakeX, y: snakeY };

    // Colisión con bordes o con sí misma
    if (snakeX < 0 || snakeY < 0 || snakeX >= canvas.width || snakeY >= canvas.height || collision(newHead, snake)) {
        clearInterval(game);
        alert(`Juego terminado. Puntaje: ${score}`);
        saveScore(score); // Guardar el puntaje
    }

    snake.unshift(newHead);
}

let game = setInterval(drawGame, 100);

// Guardar el puntaje en la base de datos
function saveScore(score) {
    fetch('guardar_puntaje.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `score=${score}`
    });
}
