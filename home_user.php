<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BD Estudiantes - Ingreso</title>
    <link rel="stylesheet" href="styles-home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <script>
        function openPopup(nombre, email) {
            alert("Editar usuario: " + nombre + "\nCorreo: " + email);
        }

        // Tateti Game
        let board = ['', '', '', '', '', '', '', '', ''];
        let currentPlayer = 'X';
        
        function makeMove(index) {
            if (board[index] === '') {
                board[index] = currentPlayer;
                document.getElementById('cell-' + index).innerText = currentPlayer;
                if (checkWinner(currentPlayer)) {
                    alert(currentPlayer + ' ha ganado!');
                    resetBoard();
                    return;
                }
                currentPlayer = currentPlayer === 'X' ? 'O' : 'X';
                if (currentPlayer === 'O') {
                    computerMove();
                }
            }
        }

        function computerMove() {
            let emptyCells = board.map((val, index) => val === '' ? index : null).filter(val => val !== null);
            if (emptyCells.length > 0) {
                let randomIndex = emptyCells[Math.floor(Math.random() * emptyCells.length)];
                makeMove(randomIndex);
            }
        }

        function checkWinner(player) {
            const winningCombinations = [
                [0, 1, 2], [3, 4, 5], [6, 7, 8],
                [0, 3, 6], [1, 4, 7], [2, 5, 8],
                [0, 4, 8], [2, 4, 6]
            ];
            return winningCombinations.some(combination =>
                combination.every(index => board[index] === player)
            );
        }

        function resetBoard() {
            board = ['', '', '', '', '', '', '', '', ''];
            currentPlayer = 'X';
            for (let i = 0; i < 9; i++) {
                document.getElementById('cell-' + i).innerText = '';
            }
        }
    </script>

</head>
<body style="margin: 0;">
    <div class="header-home">
        <nav class="nav-menu">
            <div class="logo-unso">
                <img src="img/logo-unso1.png" alt="logo-unso-san-isidro" width="250">
            </div>
            <div class="btn-log-out">
                <a href="logout.php">Cerrar sesión</a>
            </div>
        </nav>
    </div>

    <div class="conteiner-home">
        <h1>BD ESTUDIANTES</h1>
        <h2 class="title-h2">Bienvenido/a <?php echo htmlspecialchars($_SESSION['usuario']); ?></h2>
        <p>Usted no tiene permiso para hacer absolutamente nada, diviértase con este juego</p>
        <div class="tateti-board">
            <?php for ($i = 0; $i < 9; $i++): ?>
                <div id="cell-<?php echo $i; ?>" class="tateti-cell" onclick="makeMove(<?php echo $i; ?>)"></div>
            <?php endfor; ?>
        </div>
        <button class="reset-button" onclick="resetBoard()">Reiniciar Juego</button>
    </div>
</body>
</html>
