<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contate-nos</title>

  <style>

body:before {
  font-family: "Poppins", sans-serif;
  background: #f5f6f7;
  margin: 0;
  padding: 0;
content: " ";
height: 100vh;
width: 100vw;
display: block;
position: fixed; 
top: 0; 
left: 0; 
z-index: 100;
background-image: url(https://i.pinimg.com/originals/10/54/86/10548640082090279def7955d69f3d62.gif);
background-size: cover;
background-repeat: no-repeat;
background-position:center;
animation: yourAnimation 1s ease 2s 1 normal forwards;
pointer-events: none;}

@keyframes yourAnimation { 0.0%{ opacity: 1;} 75%{ opacity: 1; } 100%{ opacity: 0;}
};

.container {
  max-width: 1000px;
  margin: 50px auto;
  padding: 0 20px;
}

.title {
  text-align: center;
  font-size: 1.8rem;
  margin-bottom: 40px;
}

/* ---------- Grade de cards (2 colunas) ---------- */
.cards-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 30px;
  justify-items: center;
}

/* ---------- Card principal ---------- */
.card {
  background: white;
  border-radius: 16px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  overflow: hidden;
  width: 100%;
  max-width: 350px;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 16px rgba(0,0,0,0.15);
}

.card-image {
  background: #ff2200bd;
  height: 140px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.card-image img {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  object-fit: cover;
}

.card-content {
  padding: 20px;
  text-align: center;
}

.card-title {
  font-size: 1.1rem;
  font-weight: 600;
  margin-bottom: 8px;
}

.card-desc {
  color: #555;
  font-size: 0.85rem;
  margin-bottom: 15px;
}

    /* ---------- Botão ---------- */
    .card-btn {
      display: inline-block;
      background: linear-gradient(to right, #e67d4cff, #d25931ff);
      color: white;
      padding: 10px 25px;
      border-radius: 12px;
      text-decoration: none;
      font-weight: 500;
      transition: background 0.3s ease;
    }

    .card-btn:hover {
      background: linear-gradient(to right, #da4e23ff, #d76a62ff);
    }

    /* ---------- Responsivo ---------- */
@media (max-width: 700px) {
  .cards-grid {
    grid-template-columns: 1fr;
  }
}
  </style>
</head>
<body>

  <div class="container">
  <h2 class="title">Contacte-nos</h2>

  <div class="cards-grid">
    <div class="card">
      <div class="card-image">
        <img src="./fotos/bebelly.png">
      </div>
      <div class="card-content">
        <h3 class="card-title">Isabelly Magalhães</h3>
        <p class="card-desc">isabelly.magalhaes@estudante.ifgoiano.edu.br</p>
        <a href="https://github.com/bebellyferreira" class="card-btn" target="_blank">Contactar</a>
      </div>
    </div>

    <div class="card">
      <div class="card-image">
        <img src="./fotos/pedro.png">
      </div>
      <div class="card-content">
        <h3 class="card-title">Pedro Braz</h3>
        <p class="card-desc">pedro.braz@estudante.ifgoiano.edu.br</p>
        <a href="https://github.com/SunFellings" class="card-btn" target="_blank">Contactar</a>
      </div>
    </div>

    <div class="card">
      <div class="card-image">
        <img src="./fotos/sarah.png">
      </div>
      <div class="card-content">
        <h3 class="card-title">Sarah Gabriela</h3>
        <p class="card-desc">sarah.gabriela@estudante.ifgoiano.edu.br</p>
        <a href="https://github.com/kowakop" class="card-btn" target="_blank">Contactar</a>
      </div>
    </div>

    <div class="card">
      <div class="card-image">
        <img src="./fotos/gustavo.png">
      </div>
      <div class="card-content">
        <h3 class="card-title">Gustavo Sérgio</h3>
        <p class="card-desc">gustavo.sergio@estudante.ifgoiano.edu.br</p>
        <a href="https://github.com/GustavoTsu" class="card-btn" target="_blank">Contactar</a>
      </div>
    </div>
  </div>
</div>


</body>
</html>
